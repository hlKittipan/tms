<?php

namespace App\Http\Controllers;

use App\Model\LogActivity;
use App\Model\Province;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $province = Province::all()->sortBy('name')->pluck('name','id');
        return view('font.index', compact('topSales', 'promotion','province'));
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
        //dd($request->all());

        //$data = productSearch($request->all());
        return view('font.search');
    }
}
