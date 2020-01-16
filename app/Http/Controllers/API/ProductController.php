<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Transport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;

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
        $data = DB::table('products as p')
            ->select('p.id','p.code', 'p.name', 'p.overview','p.includes','p.excludes','p.conditions','p.itinerary' ,'p.remark','p.number_of_pax',
                'i.src', 'i.title', 'i.alt','i.description',
                'pri.public_adult', 'pri.public_child', 'pri.public_infant','pri.status',
                's_pri.public_adult as s_adult', 's_pri.public_child as s_child', 's_pri.public_infant as s_infant',
                'pe.date_end', 'pe.date_start')
            ->join('periods as pe', function ($join) {
                $join->on('p.id', '=', 'pe.product_id')
                    ->whereDate('pe.date_end', '>=', Carbon::today())
                    ->whereDate('pe.date_start', '<', Carbon::today());
            })
            ->leftJoin('prices as pri', function ($join) {
                $join->on('pe.id', '=', 'pri.period_id')
                    ->where('pri.status', '=', 1);
            })
            ->leftJoin('prices as s_pri', function ($join) {
                $join->on('pe.id', '=', 's_pri.period_id')
                    ->where('s_pri.status', '=', 2);
            })
            ->join('product_many_images as pm', 'p.id', '=', 'pm.product_id')
            ->join('images as i', function ($join) {
                $join->on('i.id', '=', 'pm.images_id')
                    ->where('i.type', '=', 'Main');
            })
            ->distinct()->inRandomOrder('8')->get();
        $result = new \stdClass();
        if (!$data->isEmpty()) {

            foreach ($data as $value) {
                $id = $value->id;
                $result->{$id} = loopKeyValue($id, $value);
            }
        }else{
            $result->data = "Not Product";
        }
        return response()->json($result);
    }

    public function getProductDetail ($product_id) {
        $result = productDetail($product_id);
        return $result;
    }
}
