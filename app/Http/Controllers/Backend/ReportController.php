<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        if (isset($request->dates)){
            //dd(explode(' - ',$request->dates));
        }
        return view('backends.report.sales');
    }
}
