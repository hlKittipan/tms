<?php

use App\Model\Quotation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

if (!function_exists('productDetail')) {
    function productDetail($product_id)
    {
        $data = DB::table('products as p')
            ->select('p.id', 'p.code', 'p.name', 'p.overview', 'p.includes', 'p.excludes', 'p.conditions', 'p.itinerary', 'p.remark', 'p.number_of_pax',
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
            ->distinct()->get();
        //dd($data);
        $result = new stdClass();
        if (!$data->isEmpty()) {
            foreach ($data as $value) {
                $id = $value->id;
                $result = loopKeyValue($id, $value);
                $result->images = productGetImage($id);
                $result->periods = productGetPeriod($id);
            }
        } else {
            $result = false;
        }
        //dd($result);
        if ($result == false) {
            abort(404);
        } else {
            return $result;
        }
    }
}

if (!function_exists('productGetImage')) {
    function productGetImage($product_id)
    {
        $data = DB::table('product_many_images as pm')
            ->join('images as i', 'pm.images_id', '=', 'i.id')
            ->where('pm.product_id', '=', $product_id)->get();

        $result = new stdClass();
        if (!$data->isEmpty()) {
            foreach ($data as $value) {
                $id = $value->id;
                $result->{$id} = loopKeyValue($id, $value);
            }
        }
        return $result;
    }
}

if (!function_exists('productGetPeriod')) {
    function productGetPeriod($product_id)
    {
        $data = DB::table('periods as pe')
            ->select('pe.id', 'pe.date_end', 'pe.date_start', 'pe.sun', 'pe.mon', 'pe.tue', 'pe.wed', 'pe.thu', 'pe.fri', 'pe.sat',
                'pri.id as price_id', 'pri.public_adult', 'pri.public_child', 'pri.public_infant', 'pri.status',
                's_pri.public_adult as s_adult', 's_pri.public_child as s_child', 's_pri.public_infant as s_infant',
                's_pri.id as s_price_id')
            ->leftJoin('prices as pri', function ($join) {
                $join->on('pe.id', '=', 'pri.period_id')
                    ->where('pri.status', '=', 1);
            })
            ->leftJoin('prices as s_pri', function ($join) {
                $join->on('pe.id', '=', 's_pri.period_id')
                    ->where('s_pri.status', '=', 2);
            })
            ->whereDate('pe.date_end', '>=', Carbon::today())
            ->whereDate('pe.date_start', '<', Carbon::today())
            ->where('pe.product_id', '=', $product_id)
            ->get();

        $result = [];
        if (!$data->isEmpty()) {
            foreach ($data as $value) {
                $id = $value->id;
                $result[] = loopKeyValue($id, $value);
            }
        }
        //dd($result);
        return $result;
    }
}

if (!function_exists('productTopSales')) {
    function productTopSales()
    {
        $data = DB::table('products as p')
            ->select('p.id', 'p.code', 'p.name', 'p.overview', 'p.includes', 'p.excludes', 'p.conditions', 'p.itinerary', 'p.remark', 'p.number_of_pax',
                'i.src', 'i.title', 'i.alt', 'i.description',
                'pri.public_adult', 'pri.public_child', 'pri.public_infant', 'pri.status',
                's_pri.public_adult as s_adult', 's_pri.public_child as s_child', 's_pri.public_infant as s_infant',
                'pe.date_end', 'pe.date_start')
            ->join('periods as pe', function ($join) {
                $join->on('p.id', '=', 'pe.product_id')
                    ->whereDate('pe.date_end', '>=', Carbon::today())
                    ->whereDate('pe.date_start', '<=', Carbon::today());
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
        }
        return $result;
    }
}

if (!function_exists('productPromotion')) {
    function productPromotion()
    {
        $data = DB::table('products as p')
            ->select('p.id', 'p.code', 'p.name', 'p.overview', 'p.includes', 'p.excludes', 'p.conditions', 'p.itinerary', 'p.remark', 'p.number_of_pax',
                'i.src', 'i.title', 'i.alt', 'i.description',
                'pri.public_adult', 'pri.public_child', 'pri.public_infant', 'pri.status',
                's_pri.public_adult as s_adult', 's_pri.public_child as s_child', 's_pri.public_infant as s_infant',
                'pe.date_end', 'pe.date_start')
            ->join('periods as pe', function ($join) {
                $join->on('p.id', '=', 'pe.product_id')
                    ->whereDate('pe.date_end', '>=', Carbon::today())
                    ->whereDate('pe.date_start', '<=', Carbon::today());
            })
            ->leftJoin('prices as pri', function ($join) {
                $join->on('pe.id', '=', 'pri.period_id')
                    ->where('pri.status', '=', 1);
            })
            ->join('prices as s_pri', function ($join) {
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
        }
        return $result;
    }
}

if (!function_exists('productSearch')) {
    function productSearch($request)
    {
        $data = DB::table('products as p')
            ->select('p.id', 'p.code', 'p.name', 'p.overview', 'p.includes', 'p.excludes', 'p.conditions', 'p.itinerary', 'p.remark', 'p.number_of_pax',
                'i.src', 'i.title', 'i.alt', 'i.description',
                'pri.public_adult', 'pri.public_child', 'pri.public_infant', 'pri.status',
                's_pri.public_adult as s_adult', 's_pri.public_child as s_child', 's_pri.public_infant as s_infant',
                'pe.date_end', 'pe.date_start')
            ->join('periods as pe', function ($join) {
                $join->on('p.id', '=', 'pe.product_id')
                    ->whereDate('pe.date_end', '>=', Carbon::today())
                    ->whereDate('pe.date_start', '<=', Carbon::today());
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
            });

        if (isset($request->search)) {
            $data = $data->where('p.name', 'like', '%' . $request->search . '%');
            session()->put('search', $request->search);
        }

        if (isset($request->country) || $request->country != 0) {
            if (is_array($request->country) == false) {
                $request->country = array($request->country);
            }
            $data = $data->whereIn('p.province_id', $request->country);
            session()->put('country', $request->country);
        }

        if (isset($request->month)) {
            $data = $data->whereMonth('pe.date_start', '<=', changeFormatDate($request->month, 'm'));
            $data = $data->whereYear('pe.date_start', '<=', changeFormatDate($request->month, 'Y'));
            $data = $data->whereMonth('pe.date_end', '>=', changeFormatDate($request->month, 'm'));
            $data = $data->whereYear('pe.date_end', '>=', changeFormatDate($request->month, 'Y'));
            session()->put('month', $request->month);
        }

        if (isset($request->adult)) {
            //$data = $data->whereMonth('created_at', '=', $request->month);
            session()->put('adult', $request->adult);
        }
        if (isset($request->child)) {
            //$data = $data->whereMonth('created_at', '=', $request->month);
            session()->put('child', $request->child);
        }
        $data = $data->distinct()->paginate('25');
        //dd($data);
        return $data;
    }
}

if (!function_exists('checkProductAvailable')) {
    function checkProductAvailable($request)
    {
    }
}

if (!function_exists('checkBookUnique')) {
    function checkBookUnique($book_no)
    {
        $check = Quotation::where('book_no', '=', $book_no)->first();
        if ($check) {
            $checkBookUnique = true;
        } else {
            $checkBookUnique = false;
        }
        return $checkBookUnique;
    }
}

if (!function_exists('getBookDetail')) {
    function getBookDetail($quo_id)
    {
        $data = DB::table('quotations as q')
            ->join('quotation_details as qe', 'q.id', '=', 'qe.quo_id')
            ->join('products as p', 'qe.product_id', '=', 'p.id')
            ->where('q.id', '=', $quo_id)
            ->select('qe.unit_adult','qe.unit_child','qe.unit_infant','qe.public_adult','qe.public_child','qe.public_infant',
                'qe.discount','qe.vat','qe.total','qe.net','p.name','p.id','p.overview')->get();
        return $data;
    }
}

if (!function_exists('getClientDetail')) {
    function getClientDetail($quo_id){
        $data = DB::table('quotations as q')
            ->join('clients as c', 'q.client_id', '=', 'c.id')
            ->where('q.id', '=', $quo_id)
            ->select('c.id as client_id','c.first_name','c.last_name','c.email','c.passport','c.hotel_name','c.room_number','c.hotel_tel')
            ->get();
        return $data;
    }
}
if (!function_exists('notify_message')) {
    function notify_message($message)
    {
        //Line setting
        define('LINE_API',"https://notify-api.line.me/api/notify");
        $token = "Xr2KCIswKYvPHioP9NbrwySrz2xCl6RnkMyarrUVKkf"; //ใส่Token ที่copy เอาไว้

        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . $token . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData
            ),
        );
        $context = stream_context_create($headerOptions);
        $result = @file_get_contents(LINE_API, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }
}
