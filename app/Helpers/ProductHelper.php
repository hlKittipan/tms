<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

if (!function_exists('productDetail')) {
    function productDetail($product_id)
    {
        $data = DB::table('products as p')
            ->select('p.id', 'p.code', 'p.name', 'p.overview', 'p.includes', 'p.excludes', 'p.conditions', 'p.itinerary', 'p.remark', 'p.number_of_pax',
                'i.id as image_id','i.src', 'i.title', 'i.alt', 'i.description', 'i.file_path', 'i.file_name', 'i.type',
                'pri.public_adult', 'pri.public_child', 'pri.public_infant', 'pri.status',
                'pe.date_end', 'pe.date_start', 'pe.sun', 'pe.mon', 'pe.tue', 'pe.wed', 'pe.thu', 'pe.fri', 'pe.sat',
                'h.icon', 'h.title', 'h.description')
            ->join('periods as pe', function ($join) {
                $join->on('p.id', '=', 'pe.product_id')
                    ->whereDate('pe.date_end', '>=', Carbon::today())
                    ->whereDate('pe.date_start', '<', Carbon::today());
            })
            ->join('prices as pri', function ($join) {
                $join->on('pe.id', '=', 'pri.period_id')
                    ->where('pri.status', '!=', 0);
            })
            ->leftJoin('product_many_images as pm', 'p.id', '=', 'pm.product_id')
            ->leftJoin('images as i', function ($join) {
                $join->on('i.id', '=', 'pm.images_id')
                    ->where('i.type', '=', 'Main');
            })
            ->leftJoin('product_many_highlights as ph', 'p.id', '=', 'ph.product_id')
            ->leftJoin('highlights as h', 'h.id', '=', 'ph.highlight_id')
            ->where('p.id', '=', $product_id)
            ->get();
        //dd($data);
        if (!$data->isEmpty()) {
            $result = new stdClass();
            foreach ($data as $value) {
                $id = $value->id;
                $result = loopKeyValue($id,$value);
                $result->{$id}->images = productGetImage($id);
            }
        }
        dd($result);
    }
}

function productGetImage($product_id)
{
    $data = DB::table('product_many_images as pm')
        ->join('images as i', 'pm.images_id', '=', 'i.id')
        ->where('pm.product_id', '=', $product_id)->get();

    if (!$data->isEmpty()) {
        $result = new stdClass();
        foreach ($data as $value) {
            $id = $value->id;
            $result = loopKeyValue($id,$value);
        }
    }
    return $result;
}

function productGetPeriod(){

}

