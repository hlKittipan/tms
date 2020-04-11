<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public $label = [], $datasets = [];

    public function getReport(Request $request)
    {
        $type = $request->reportType;
        $this->label = [];
        $this->datasets = [];
        switch ($type) {
            case "sales":
                return $this->sales($request);
                break;
            case "products":
                return $this->products($request);
                break;
        }

    }

    public function sales($request, $type = 'sales')
    {

        if (isset($request->dates)) {
            //dd($request->has('dates'));
            $date = explode(" - ", $request->dates);
            $start = changeFormatDate($date[0], 'Y-m-d');
            $end = changeFormatDate($date[1], 'Y-m-d');
            $diff_in_months = Carbon::parse($start)->diffInMonths($end);
            $diff_in_years = Carbon::parse($start)->diffInYears($end);
            $result = new \stdClass();

            $data = DB::table('quotations as q')
                ->join('quotation_details as qd', 'q.id', '=', 'qd.quo_id')
                ->join('products as p', 'qd.product_id', '=', 'p.id')
                ->whereBetween('q.quo_date', [$start, $end])
                ->groupBy(DB::raw('Year(q.quo_date)'))
                ->groupBy(DB::raw('MONTH(q.quo_date)'))
                ->selectRaw('Year(q.quo_date) as year, DATE_FORMAT(q.quo_date, "%m") as month, COUNT(*) as total')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
            for ($i = 0; $i <= $diff_in_years; $i++) {
                $year = Carbon::parse($start)->addYears($i)->format('Y');
                $result->{$year} = new \stdClass();
            }

            //dd($data);
            if ($data->isNotEmpty()) {
                foreach ($data as $key => $value) {
                    if (!(property_exists($result, $value->year))) {
                        $result->{$value->year} = new \stdClass();
                    }

                    if (!(property_exists($result->{$value->year}, "data"))) {
                        $result->{$value->year}->data = new \stdClass();
                    }

                    for ($j = 0; $j <= $diff_in_months; $j++) {
                        $monthString = Carbon::parse($start)->addMonths($j)->format('F');
                        $month = Carbon::parse($start)->addMonths($j)->format('m');
                        if ($value->month == $month) {
                            $result->{$value->year}->data->{$month} = $value->total;
                        } else {
                            if ((property_exists($result->{$value->year}->data, $month))) {
                                if ($result->{$value->year}->data->{$month} == 0 && $value->month == $month){
                                    $result->{$value->year}->data->{$month} = $value->total;
                                }
                            }else{
                                $result->{$value->year}->data->{$month} = 0;
                            }
                        }
                    }

                }
                //dd($result, $data, property_exists($result->{"2018"}, "data"), count((array)$result->{"2020"}->data));
            }

        }
        return view('backends.report.sales', compact('result', 'type'));
    }

    public function products($request, $type = 'products')
    {
        if (isset($request->dates)) {
            //dd($request->has('dates'));
            $date = explode(" - ", $request->dates);
            $start = changeFormatDate($date[0], 'Y-m-d');
            $end = changeFormatDate($date[1], 'Y-m-d');
            $diff_in_months = Carbon::parse($start)->diffInMonths($end);
            $diff_in_years = Carbon::parse($start)->diffInYears($end);
            $result = new \stdClass();

            $data = DB::table('quotations as q')
                ->join('quotation_details as qd', 'q.id', '=', 'qd.quo_id')
                ->join('products as p', 'qd.product_id', '=', 'p.id')
                ->whereBetween('q.quo_date', [$start, $end])
                ->groupBy(DB::raw('Year(q.quo_date)'))
                ->groupBy(DB::raw('MONTH(q.quo_date)'))
                ->groupBy('qd.product_id')
                ->selectRaw('Year(q.quo_date) as year, DATE_FORMAT(q.quo_date, "%m") as month, COUNT(*) as total,p.name,p.id')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
            for ($i = 0; $i <= $diff_in_years; $i++) {
                $year = Carbon::parse($start)->addYears($i)->format('Y');
                $result->{$year} = new \stdClass();
            }

            //dd($data);
            if ($data->isNotEmpty()) {
                foreach ($data as $key => $value) {
                    if (!(property_exists($result, $value->year))) {
                        $result->{$value->year} = new \stdClass();
                    }

                    if (!(property_exists($result->{$value->year}, "data"))) {
                        $result->{$value->year}->data = new \stdClass();
                    }

                    if (!(property_exists($result->{$value->year}->data, $value->id))) {
                        $result->{$value->year}->data->{$value->id} = new \stdClass();
                        $result->{$value->year}->data->{$value->id}->name = $value->name;
                    }

                    for ($j = 0; $j <= $diff_in_months; $j++) {
                        $monthString = Carbon::parse($start)->addMonths($j)->format('F');
                        $month = Carbon::parse($start)->addMonths($j)->format('m');
                        if ($value->month == $month) {
                            $result->{$value->year}->data->{$value->id}->{$month} = $value->total;
                        } else {
                            if ((property_exists($result->{$value->year}->data->{$value->id}, $month))) {
                                if ($result->{$value->year}->data->{$value->id}->{$month} == 0 && $value->month == $month){
                                    $result->{$value->year}->data->{$value->id}->{$month} = $value->total;
                                }
                            }else{
                                $result->{$value->year}->data->{$value->id}->{$month} = 0;
                            }
                        }
                    }

                }
                //dd($result, $data, property_exists($result->{"2018"}, "data"), count((array)$result->{"2020"}->data));
            }

        }
        return view('backends.report.product', compact('result', 'type'));
    }
}
