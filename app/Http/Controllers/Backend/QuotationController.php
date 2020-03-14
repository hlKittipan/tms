<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Product_type;
use App\Model\Client as Customer;
use App\Model\Quotation;
use App\Model\Quotation_detail;
use App\Model\QuotationManyServiceCharge;
use App\Model\Transport;
use Carbon\Carbon;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
        $quotation = DB::table('quotations as q')
            ->select('q.id', 'q.quo_date', 'c.first_name', 'c.last_name','c.hotel_name','p.name')
            ->join('clients as c', 'q.client_id', '=', 'c.id')
            ->join('quotation_details as qd',function($join){
                $join->on('qd.quo_id','=','q.id')
                ->limit(1);
            })
            ->join('products as p','p.id','=','qd.product_id')
            ->latest('q.created_at')->paginate(10);
        //dd($quotation);
        return view('backends.books.index', compact('quotation'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $quo_total = 0;
        $quo_vat = 0;
        $quo_net = 0;

        //Create client
        $client = Customer::create($request->all());

        //Upload passport client
        if ($request->hasFile('passport')) {
            $files = $request->file('passport');
            $imageName = $client->id . '.' . $files->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/client_passport/';
            $src = '/uploads/client_passport/' . $imageName;
            $files->move($destinationPath, $imageName);
            $client = Customer::create($request->all());
            DB::table('clients')->where('id', '=', $client->id)->update([
                'passport' => $src,
            ]);
        }

        //create quotation
        $quo = new Quotation();
        $quo->staff_id = Auth::user()->id;
        $quo->quo_date = Carbon::now();
        $quo->client_id = $client->id;
        $quo->save();

        //get transport price
        if ($request->has('trans_' . $request->product_id[0])) {
            $transPrice = Transport::findOrFail($request->input('trans_' . $request->product_id[0]));
            //create transport
            $trans = new QuotationManyServiceCharge();
            $trans->quo_id = $quo->id;
            $trans->charge_id = $request->input('trans_' . $request->product_id[0]);
            $trans->price = $transPrice->price;
            $trans->save();
        }

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
                $quo_detail->book_date = Carbon::parse($request->input('date_' . $product_id));
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

                $quo_total = ($quo_total + $request->input('t_' . $product_id) - $request->input('d_' . $product_id));
                $quo_vat = $quo_vat + $request->input('v_' . $product_id);
                $quo_net = ($quo_net + $request->input('nt_' . $product_id) - $request->input('d_' . $product_id));
            }
        }

        Quotation::where('id', '=', $quo->id)->update([
            'total' => $quo_total,
            'vat' => $quo_vat,
            'net' => $quo_net,
            'status' => 1,
        ]);
        return redirect()->route('backend.booking.index')->with('success', 'Booking created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Model\Quotation $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        return view('backends.books.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Model\Quotation $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quotation = DB::table('quotations as q')
            ->select('q.id as quo_id', 'q.staff_id', 'q.client_id', 'q.quo_date', 'q.total', 'q.discount_per', 'q.discount_price', 'q.vat', 'q.net', 'q.remark',
                'c.first_name', 'c.last_name', 'c.email', 'c.hotel_name', 'c.room_number', 'c.hotel_tel', 'c.passport')
            ->join('clients as c', 'c.id', '=', 'q.client_id')
            ->where('q.id', '=', $id)
            ->first();
        if (isset($quotation)) {

            $quotation->quo_detail = DB::table('quotation_details as qd')
                ->join('products as p', 'p.id', '=', 'qd.product_id')
                ->where('qd.quo_id', '=', $quotation->quo_id)
                ->get();
            $quotation->trans = DB::table('quotation_many_service_charges as qc')
                ->join('product_many_services as ps', 'qc.charge_id', '=', 'ps.id')
                ->join('transports as t','t.id','=','ps.service_id')
                ->where('qc.quo_id','=',$quotation->quo_id)
                ->select('t.id as service_id','ps.id as charge_id','qc.quo_id','t.name','t.price')
                ->first();
        }
        //dd($quotation);
        $transports = getTransports($quotation->quo_detail[0]->product_id);
        return view('backends.books.edit', compact('quotation','transports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\Quotation $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        //dd($request->all());

        $quo_total = 0;
        $quo_vat = 0;
        $quo_net = 0;

        //Upload passport client
        if ($request->hasFile('passport')) {
            $files = $request->file('passport');
            $imageName = $request->client_id . '.' . $files->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/client_passport/';
            $src = '/uploads/client_passport/' . $imageName;
            if (File::exists($destinationPath . $imageName)) {
                File::delete($destinationPath . $imageName);
            }
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $files->move($destinationPath, $imageName);
        } else {
            $src = $request->passport;
        }

        $client = Customer::findOrFail($request->client_id);
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->passport = $src;
        $client->hotel_name = $request->hotel_name;
        $client->hotel_tel = $request->hotel_tel;
        $client->room_number = $request->room_number;
        $client->save();

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
                DB::table('quotation_details')->where('quo_id', '=', $request->quotation_id)->where('product_id', '=', $product_id)
                    ->update([
                        'book_date' => Carbon::parse($request->input('date_' . $product_id)),
                        'unit_adult' => $request->input('noa_' . $product_id),
                        'unit_child' => $request->input('noc_' . $product_id),
                        'unit_infant' => $request->input('noi_' . $product_id),
                        'public_adult' => $product->public_adult,
                        'public_child' => $product->public_child,
                        'public_infant' => $product->public_infant,
                        'vat' => $request->input('v_' . $product_id),
                        'total' => $request->input('t_' . $product_id),
                        'net' => $request->input('nt_' . $product_id),
                        'discount' => $request->input('d_' . $product_id),
                        'updated_at' => Carbon::now()
                    ]);

                $quo_total = ($quo_total + $request->input('v_' . $product_id) - $request->input('d_' . $product_id));
                $quo_vat = $quo_vat + $request->input('t_' . $product_id);
                $quo_net = ($quo_net + $request->input('nt_' . $product_id) - $request->input('d_' . $product_id));
            }
        }

        $quo = Quotation::findOrFail($request->quotation_id);
        $quo->total = $quo_total;
        $quo->vat = $quo_vat;
        $quo->net = $quo_net;
        $quo->status = 1;
        $quo->save();

        return redirect()->route('backend.booking.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Quotation $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        return redirect()->route('backend.booking.index')->with('success', 'Booking delete successfully.');
    }
}
