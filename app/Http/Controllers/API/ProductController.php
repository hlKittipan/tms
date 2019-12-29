<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Transport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function searchProduct()
    {
        $product = DB::table('products as p')
            ->select('p.id', 'p.name', 'p.overview', 'pri.public_adult', 'pri.public_child', 'pri.public_infant', 'p.number_of_pax', 'pe.date_end', 'pri.status')
            ->join('periods as pe', function ($join) {
                $join->on('p.id', '=', 'pe.product_id')
                    ->whereDate('pe.date_end', '>=', Carbon::today())
                    ->whereDate('pe.date_start', '<', Carbon::today());
            })
            ->join('prices as pri', function ($join) {
                $join->on('pe.id', '=', 'pri.period_id')
                    ->where('pri.status', '!=', 0);
            })
            ->where('p.id', '=', \request('search'))
            ->orWhere('p.name', 'like', '%' . \request('search') . '%')
            ->orWhere('p.name', 'like', \request('search') . '%')
            ->orWhere('p.name', 'like', '%' . \request('search'))
            ->distinct()->paginate(10);
        return json_encode($product);
    }

    public function searchAvailable(Request $request)
    {
        $available = DB::table('quotations as q')
            ->join('quotation_details as qd', 'q.id', '=', 'qd.quo_id')
            ->join('products as p', 'p.id', '=', 'product_id')
            ->whereDate('qd.book_date', '=', Carbon::parse($request->book_date)->format('Y-m-d'))
            ->where('p.id', '=', $request->product_id)
            ->get();
        //dd($available);
        $unit = 0;
        foreach ($available as $k => $v) {
            $unit = $unit + ($v->unit_adult + $v->unit_child + $v->unit_infant);
        }

        return json_encode($unit);
    }

    public function searchTransport()
    {
        $result = Transport::where('status', '!=', '0')->get();
        return json_encode($result);
    }

    public function topSales()
    {
        $result = DB::table('products as p')
            ->select('p.id', 'p.name', 'p.overview', 'pri.public_adult', 'pri.public_child', 'pri.public_infant', 'p.number_of_pax', 'pe.date_end', 'pri.status')
            ->join('periods as pe', function ($join) {
                $join->on('p.id', '=', 'pe.product_id')
                    ->whereDate('pe.date_end', '>=', Carbon::today())
                    ->whereDate('pe.date_start', '<', Carbon::today());
            })
            ->join('prices as pri', function ($join) {
                $join->on('pe.id', '=', 'pri.period_id')
                    ->where('pri.status', '!=', 0);
            })
            ->distinct()->inRandomOrder('8')->get();
        return $result;
    }
}
