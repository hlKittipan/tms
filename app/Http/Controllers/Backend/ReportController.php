<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        if (isset($request->dates)) {
            //dd($request->has('dates'));
            "SELECT  " .
            "Year(quo_date) as year, MONTH(quo_date) as month, COUNT(qd.product_id)  " .
            "FROM " .
            "quotations AS q " .
            "INNER JOIN quotation_details AS qd ON q.id = qd.quo_id " .
            "GROUP BY MONTH(quo_date) ,Year(quo_date)";
        }

        return view('backends.report.sales');
    }
}
