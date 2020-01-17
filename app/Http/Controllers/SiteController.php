<?php

namespace App\Http\Controllers;

use App\Model\LogActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new \stdClass();
        $data->subject = 'Guest access index website';
        \LogActivity($data);
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
        $topSales = new \stdClass();
        if (!$data->isEmpty()) {

            foreach ($data as $value) {
                $id = $value->id;
                $topSales->{$id} = loopKeyValue($id, $value);
            }
        }else{
            $topSales->data = false;
        }
        return view('font.index',compact('topSales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
