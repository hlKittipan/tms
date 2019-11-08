<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Product_type;
use App\Model\Client as Customer;
use App\Model\Quotation;
use App\Model\Quotation_detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public $productType;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotation = Quotation::latest()->paginate(10);
        return view('backends.books.index',compact('quotation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backends.books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quo_product_id = array();
        $quo_total = 0;
        $quo_vat = 0;
        $quo_net = 0;

        //Create client
        $client = Customer::create($request->all());

        //Upload passport client
        if ($request->hasFile('passport')) {
            $files = $request->file('passport');
                $imageName = $client->id . '.' . $files->getClientOriginalExtension();
                $destinationPath = public_path() .'/uploads/client_passport/';
                $src = '/uploads/client_passport/'.$imageName;
                $files->move($destinationPath, $imageName);
                $client = Customer::create($request->all());
                DB::table('clients')->where('id', '=',$client->id)->update([
                    'passport' => $src,
                ]);
        }

        $quo = new Quotation();
        $quo->staff_id = Auth::user()->id;
        $quo->quo_date = Carbon::now();
        $quo->client_id = $client->id;
        $quo->save();

        if (is_array($request->product_id) || is_object($request->product_id)) {
            foreach ($request->product_id as $product_id) {
                $product = DB::table('products as p')
                    ->select('p.id as product_id', 'p.name', 'pe.id as period_id', 'pri.id as price_id',
                        'pri.public_adult', 'pri.public_child', 'pri.public_infant', 'p.number_of_pax')
                    ->join('periods as pe', function ($join) {
                        $join->on('p.id', '=', 'pe.product_id')
                            ->whereDate('pe.date_end', '>=', Carbon::today());
                    })
                    ->join('prices as pri', 'pe.id', '=', 'pri.period_id')
                    ->where('p.id', '=', $product_id)->first();
                $quo_detail = new Quotation_detail();
                $quo_detail->quo_id = $quo->id;
                $quo_detail->product_id = $product->product_id;
                $quo_detail->price_id = $product->price_id;
                $quo_detail->period_id = $product->period_id;
                $quo_detail->unit_adult = $request->input('noa_' . $product_id);
                $quo_detail->unit_child = $request->input('noc_' . $product_id);
                $quo_detail->unit_infant = $request->input('noi_' . $product_id);
                $quo_detail->public_adult = $product->public_adult;
                $quo_detail->public_child = $product->public_child;
                $quo_detail->public_infant = $product->public_infant;
                $quo_detail->vat = $request->input('v_' . $product_id);
                $quo_detail->total = $request->input('t_' . $product_id);
                $quo_detail->net = $request->input('nt_' . $product_id);
                $quo_detail->discount = $request->input('d_' . $product_id);
                $quo_detail->save();

                $quo_total = $quo_total + $request->input('v_' . $product_id);
                $quo_vat = $quo_vat + $request->input('t_' . $product_id);
                $quo_net = $quo_net + $request->input('nt_' . $product_id);
            }
        }

        Quotation::where('id', '=',$quo->id)->update([
            'total' => $quo_total,
            'vat' => $quo_vat,
            'net' => $quo_net,
        ]);
        return redirect()->route('backend.booking.index') ->with('success','Booking created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        return view('backends.books.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        return view('backends.books.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        return redirect()->route('backend.booking.index') ->with('success','Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        return redirect()->route('backend.booking.index') ->with('success','Booking delete successfully.');
    }
}
