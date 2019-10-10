<?php

namespace App\Http\Controllers\Backend;

use App\Model\Product_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTypeController extends Controller
{
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
        $productType = Product_type::latest()->paginate(10);
        return view('backend.productType.index',compact('productType'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product_type::create($request->all());
        return redirect()->route('backend.product_type.index')
            ->with('success','Product type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product_type  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(Product_type $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product_type  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_type $productType)
    {
        return view('backend.productType.edit',compact('productType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product_type  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_type $productType)
    {
        $productType->update($request->all());
        return redirect()->route('backend.product_type.index')
            ->with('success','Product type Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product_type  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_type $productType)
    {
        //
    }
}
