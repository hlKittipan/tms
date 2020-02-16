<?php

namespace App\Http\Controllers;

use App\Model\Client as Customer;
use App\Model\LogActivity;
use App\Model\Period;
use App\Model\Product;
use App\Model\Province;
use App\Model\Quotation;
use App\Model\Quotation_detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $log = new \stdClass();
        $log->subject = 'Guest access index website';
        \LogActivity($log);
        $topSales = productTopSales();
        $promotion = productPromotion();
        $province = Province::all()->sortBy('name')->pluck('name', 'id');
        return view('font.index', compact('topSales', 'promotion', 'province'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getProductdetail($product_id)
    {
        $data = productDetail($product_id);
        $cover = DB::table('product_many_images as pm')
            ->join('images as i', function ($join) {
                $join->on('i.id', '=', 'pm.images_id')
                    ->where('i.type', '=', 'Cover');
            })
            ->where('pm.product_id', '=', $product_id)
            ->first();
        //dd($data);
        return view('font.product-detail', compact('data', 'cover'));
    }

    public function postProductSearch(Request $request)
    {
        //dd($request->all(),isset($request->adult),Carbon::parse($request->month)->format('m'));
        $data = new \stdClass();
        $data->result = productSearch($request);
        $data->province = Province::pluck('name', 'id');
        //dd($data);
        return view('font.search', compact('data'));
    }

    public function addToCart($id)
    {
        $product = Product::find($id);

        if (!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {

            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "photo" => $product->photo
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function checkScheduler(Request $request)
    {
        //dd($request->all());
        $date = '';
        $start = changeFormatDate($request->start, 'Y-m-d');
        $end = changeFormatDate($request->end, 'Y-m-d');
        $day = Carbon::parse($request->start);

        $diff = Carbon::parse($request->start)->diffInDays(Carbon::parse($request->end));

        $data = collect(DB::select('SELECT p.name, p.number_of_pax, ( unit_child + unit_adult + unit_infant ) AS unit_total,  date(book_date) as book_date' .
            ' FROM products AS p ' .
            ' INNER JOIN periods AS pe ON p.id = pe.product_id ' .
            ' INNER JOIN quotation_details AS qd ON p.id = qd.product_id ' .
            ' WHERE qd.product_id = ' . $request->product_id . ' AND qd.price_id = ' . $request->price_id . ' AND qd.period_id = ' . $request->period_id . ' ' .
            ' and pe.date_start <= "' . $start . '" ' .
            ' and pe.date_end >= "' . $end . '" ' .
            ' and book_date between  "' . $start . '" and "' . $end . '" '));
        $product = Product::findOrfail($request->product_id);
        for ($i = 0; $i < $diff; $i++) {
            $date = Carbon::parse($request->start)->addDays($i)->format('Y-m-d');
            $checkData = $data->where('book_date', $date);
            if ($checkData->isEmpty()) {
                $result[] = array(
                    'id' => $i + 1,
                    'title' => '0/' . $product->number_of_pax,
                    'start' => $date,
                    'color' => 'green',
                    'textColor' => 'white',
                    'url' => route('quotations', ['_token' => csrf_token(), 'date' => $date, 'product_id' => $request->product_id, 'price_id' => $request->price_id, 'period_id' => $request->period_id, 'unit_total' => 0]),

                );

            } else {
                foreach ($checkData as $k => $v) {
                    $ref_color = $v->unit_total >= $product->number_of_pax ? 'red' : 'green';
                    $result[] = array(
                        'id' => $i + 1,
                        'title' => $v->unit_total . '/' . $product->number_of_pax,
                        'start' => $v->book_date,
                        'color' => $ref_color,
                        'textColor' => 'white',
                        'url' => route('quotations', ['_token' => csrf_token(), 'date' => $v->book_date, 'product_id' => $request->product_id, 'price_id' => $request->price_id, 'period_id' => $request->period_id, 'unit_total' => $v->unit_total]),
                    );
                }
            }
        }
        return json_encode($result);
    }

    public function getQuotations(Request $request)
    {
        //dd($request->all());
        $data = Product::findOrFail($request->product_id);
        $data->price = productGetPeriod($request->product_id);
        $data->book_date = $request->date;
        $data->unit_total = $request->unit_total;
        //dd($data);

        return view('font.quotations', compact('data'));
    }

    public function checkAvailable(Request $request)
    {
        //dd($request->all());
        $available = DB::table('quotations as q')
            ->join('quotation_details as qd', 'q.id', '=', 'qd.quo_id')
            ->join('products as p', 'p.id', '=', 'product_id')
            ->whereDate('qd.book_date', '=', Carbon::parse($request->book_date)->format('Y-m-d'))
            ->where('p.id', '=', $request->product_id);
        if ($request->s_price_id == null) {
            $available = $available->where('qd.price_id', '=', $request->price_id);
        } else {
            $available = $available->where('qd.price_id', '=', $request->s_price_id);
        }
        $available = $available->where('qd.period_id', '=', $request->period_id)
            ->select(DB::raw('(qd.unit_child + qd.unit_adult + qd.unit_infant) as total'), 'p.number_of_pax')
            ->first();
        if (($available->total + $request->total_pax) >= $available->number_of_pax) {
            return json_encode('Over off limit');
        }
        return json_encode(true);
    }

    public function storeQuotations(Request $request)
    {
        //dd($request->all());
        $next_data = $request->all();
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
        $quo->staff_id = 0;
        $quo->quo_date = Carbon::now();
        $quo->client_id = $client->id;
        $quo->save();

        $product = DB::table('products as p')
            ->join('periods as pe', 'p.id', '=', 'pe.product_id')
            ->join('prices as pri', 'pe.id', '=', 'pri.period_id')
            ->select('p.id as product_id', 'p.name', 'pe.id as period_id', 'pri.id as price_id',
                'pri.public_adult', 'pri.public_child', 'pri.public_infant', 'p.number_of_pax')
        ->where('p.id','=',$request->product_id);
        if ($request->s_price_id == null) {
            $product = $product->where('pri.id', '=', $request->price_id);
        } else {
            $product = $product->where('pri.id', '=', $request->s_price_id);
        }
        $product = $product->where('pe.id', '=', $request->period_id)
            ->first();
        $quo_detail = new Quotation_detail();
        $quo_detail->quo_id = $quo->id;
        $quo_detail->product_id = $product->product_id;
        $quo_detail->price_id = $product->price_id;
        $quo_detail->period_id = $product->period_id;
        $quo_detail->book_date = Carbon::parse($request->input('date_' . $request->product_id));
        $quo_detail->unit_adult = $request->input('noa_' . $request->product_id);
        $quo_detail->unit_child = $request->input('noc_' . $request->product_id);
        $quo_detail->unit_infant = $request->input('noi_' . $request->product_id);
        $quo_detail->public_adult = $product->public_adult;
        $quo_detail->public_child = $product->public_child;
        $quo_detail->public_infant = $product->public_infant;
        $quo_detail->vat = $request->input('v_' . $request->product_id);
        $quo_detail->total = $request->input('t_' . $request->product_id);
        $quo_detail->net = $request->input('nt_' . $request->product_id);
        $quo_detail->discount = $request->input('d_' . $request->product_id);
        $quo_detail->save();

        $quo_total = ($quo_total + $request->input('t_' . $request->product_id));
        $quo_vat = $quo_vat + $request->input('v_' . $request->product_id);
        $quo_net = ($quo_net + $request->input('nt_' . $request->product_id) - $request->input('d_' . $request->product_id));

        Quotation::where('id', '=', $quo->id)->update([
            'total' => $quo_total,
            'vat' => $quo_vat,
            'net' => $quo_net,
            'status' => 1,
        ]);
        $quo = Quotation::findOrFail($quo->id);
        return view('font.show', compact('next_data', 'quo', 'client', 'product'));
    }

    public function getBook(Request $request)
    {

        return view('font.show');
    }
}
