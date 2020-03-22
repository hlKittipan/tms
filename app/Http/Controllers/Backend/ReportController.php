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
                $this->sales($request);
                break;
            case "products":
                $this->products($request);
                break;
        }
        return view('backends.report.sales')
            ->with('label', json_encode($this->label))
            ->with('datasets', json_encode($this->datasets))
            ->with('type', $type);

    }

    function sales($request, $type = 'sales')
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
                ->whereBetween('q.quo_date', [$start, $end])
                ->groupBy(DB::raw('MONTH(q.quo_date)', 'Year(q.quo_date)'))
                ->selectRaw('Year(q.quo_date) as year, DATE_FORMAT(q.quo_date, "%m") as month, COUNT(qd.product_id) as total')
                ->orderBy('year', 'asc')
                ->get();
            $array_month = array();
            if ($data->isNotEmpty()) {
                foreach ($data as $key => $value) {
                    $result->datasets->{$value->year}[$value->month] = $value->total;
                    if (Arr::has($array_month, $value->year)) {
                        if (!Arr::has($array_month[$value->year], $value->month)) {
                            $array_month[$value->year] = Arr::add($array_month[$value->year], $value->month, $value->total);
                        }
                    } else {
                        $array_month = Arr::add($array_month, $value->year, [$value->month => $value->total]);
                    }
                }
                for ($i = 0; $i <= $diff_in_years; $i++) {
                    $year = Carbon::parse($start)->addYears($i)->format('Y');
                    $color = 'rgb(' . rand(100, 300) . ',' . rand(100, 300) . ',' . rand(100, 300) . ')';
                    $result->year[] = $year;
                    $result->label = array();
                    $array = array();
                    $array = Arr::add($array, 'label', $year);
                    $array = Arr::add($array, 'borderColor', $color);
                    $array = Arr::add($array, 'backgroundColor', $color);
                    $array = Arr::add($array, 'pointBorderWidth', 3);
                    for ($j = 0; $j <= $diff_in_months; $j++) {
                        $monthString = Carbon::parse($start)->addMonths($j)->format('F');
                        $month = Carbon::parse($start)->addMonths($j)->format('m');
                        if (!Arr::has($result->label, $month)) {
                            $result->label[$month] = $monthString;
                        }
                        if (Arr::has($array_month, $year)) {
                            if (!Arr::has($array_month[$year], $month)) {
                                $array_month[$year] = Arr::add($array_month[$year], $month, 0);
                            }
                        } else {
                            $array_month = Arr::add($array_month, $year, [$month => 0]);
                        }
                    }
                    foreach (Arr::sortRecursive($array_month[$year]) as $key => $value) {
                        $array_data[$year][] = $value;
                    }

                    $array = Arr::add($array, 'data', $array_data[$year]);
                    $result->datasets->{$year} = $array;

                }
                foreach ($result->datasets as $key => $value) {
                    $this->datasets[] = $value;
                }
                foreach (Arr::sortRecursive($result->label) as $key => $value) {
                    $this->label[] = $value;
                }
            }
            //dd($datasets,$label);
        }

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
                ->whereBetween('q.quo_date', [$start, $end])
                ->groupBy(DB::raw('MONTH(q.quo_date)', 'Year(q.quo_date)'))
                ->selectRaw('Year(q.quo_date) as year, DATE_FORMAT(q.quo_date, "%m") as month, COUNT(qd.product_id) as total')
                ->orderBy('year', 'asc')
                ->get();
            $array_month = array();
            if ($data->isNotEmpty()) {
                foreach ($data as $key => $value) {
                    $result->datasets->{$value->year}[$value->month] = $value->total;
                    if (Arr::has($array_month, $value->year)) {
                        if (!Arr::has($array_month[$value->year], $value->month)) {
                            $array_month[$value->year] = Arr::add($array_month[$value->year], $value->month, $value->total);
                        }
                    } else {
                        $array_month = Arr::add($array_month, $value->year, [$value->month => $value->total]);
                    }
                }
                for ($i = 0; $i <= $diff_in_years; $i++) {
                    $year = Carbon::parse($start)->addYears($i)->format('Y');
                    $color = 'rgb(' . rand(100, 300) . ',' . rand(100, 300) . ',' . rand(100, 300) . ')';
                    $result->year[] = $year;
                    $result->label = array();
                    $array = array();
                    $array = Arr::add($array, 'label', $year);
                    $array = Arr::add($array, 'borderColor', $color);
                    $array = Arr::add($array, 'backgroundColor', $color);
                    $array = Arr::add($array, 'pointBorderWidth', 3);
                    for ($j = 0; $j <= $diff_in_months; $j++) {
                        $monthString = Carbon::parse($start)->addMonths($j)->format('F');
                        $month = Carbon::parse($start)->addMonths($j)->format('m');
                        if (!Arr::has($result->label, $month)) {
                            $result->label[$month] = $monthString;
                        }
                        if (Arr::has($array_month, $year)) {
                            if (!Arr::has($array_month[$year], $month)) {
                                $array_month[$year] = Arr::add($array_month[$year], $month, 0);
                            }
                        } else {
                            $array_month = Arr::add($array_month, $year, [$month => 0]);
                        }
                    }
                    foreach (Arr::sortRecursive($array_month[$year]) as $key => $value) {
                        $array_data[$year][] = $value;
                    }

                    $array = Arr::add($array, 'data', $array_data[$year]);
                    $result->datasets->{$year} = $array;

                }
                foreach ($result->datasets as $key => $value) {
                    $this->datasets[] = $value;
                }
                foreach (Arr::sortRecursive($result->label) as $key => $value) {
                    $this->label[] = $value;
                }
            }
            //dd($datasets,$label);
        }

    }
}
