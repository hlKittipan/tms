<?php

namespace App\Http\Controllers\Backend;

use App\Model\Product;
use App\Model\Product_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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
        $this->productType = Product_type::get()->pluck('name','id');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->paginate(10);
        //dd($product);
        return view('backends.products.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productType = $this->productType;
        $product_id = 0;
        return view('backends.products.create',compact('productType','product_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number_of_pax' => 'required|numeric',
            'duration_days' => 'required|numeric',
            'duration_nights' => 'required|numeric',
        ]);
        $code = Carbon::now()->format('ymdhms');
        request()->merge(['status' => '1','code'=>$code,'staff_id' => Auth::user()->id]);
        $product = Product::create($request->all());
        return redirect()->route('backend.product.after',$product->id)
            ->with('success','Product created successfully.');
    }

    public function afterCreateProduct($id){
        $productType = $this->productType;
        $product = Product::findOrFail($id);
        return view('backends.products.afterCreateProduct',compact('productType','product'));
    }

    public function createPeriod($id){
        $product_id = $id;
        return view('backends.periods.create',compact('product_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
