<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function searchProduct(){
        $product = DB::table('products as p')
            ->select('p.id','p.name','pri.public_adult','pri.public_child','pri.public_infant')
            ->join('periods as pe', function ($join) {
                $join->on('p.id','=','pe.product_id')
                    ->where('pe.date_end','>',Carbon::today());
            })
            ->join('prices as pri','pe.id','=','pri.period_id')
            ->where('p.id','=',\request('search'))
            ->orWhere('p.name','like',\request('search'))
            ->distinct()->paginate(10);
        return json_encode($product);
    }
}
