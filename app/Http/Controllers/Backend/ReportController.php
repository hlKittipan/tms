<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        if (isset($request->dates)) {
            //dd($request->has('dates'));
            $date = explode(" - ",$request->dates);
            $start = changeFormatDate($date[0],'Y-m-d');
            $end = changeFormatDate($date[1],'Y-m-d');

            $data = DB::table('quotations as q')
                ->join('quotation_details as qd','q.id','=','qd.quo_id')
                ->whereBetween('q.quo_date',[$start,$end])
                ->groupBy(DB::raw('MONTH(q.quo_date)' ,'Year(q.quo_date)'))
                ->selectRaw('Year(q.quo_date) as year, MONTH(q.quo_date) as month, COUNT(qd.product_id)'  )
                ->orderBy('year','asc')
                ->get();
            //dd($data);
        }

        return view('backends.report.sales');
    }
}
