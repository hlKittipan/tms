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
            ->select('p.id','p.name','pri.public_adult','pri.public_child','pri.public_infant','p.number_of_pax')
            ->join('periods as pe', function ($join) {
                $join->on('p.id','=','pe.product_id')
                    ->whereDate('pe.date_end','>=',Carbon::today());
            })
            ->join('prices as pri','pe.id','=','pri.period_id')
            ->where('p.id','=',\request('search'))
            ->orWhere('p.name','like','%'.\request('search').'%')
            ->orWhere('p.name','like',\request('search').'%')
            ->orWhere('p.name','like','%'.\request('search'))
            ->distinct()->paginate(10);
        return json_encode($product);
    }

    public function searchAvailable(Request $request){
        $available = DB::table('quotations as q')
            ->join('quotation_details as qd','q.id','=','qd.quo_id')
            ->join('products as p','p.id','=','product_id')
            ->whereDate('qd.book_date','=',Carbon::parse($request->book_date)->format('Y-m-d'))
            ->where('p.id','=',$request->product_id)
            ->get();
        //dd($available);
        $unit = 0;
        foreach ($available as $k => $v){
            $unit = $unit + ($v->unit_adult + $v->unit_child + $v->unit_infant);
        }

        return json_encode($unit);
    }
}
