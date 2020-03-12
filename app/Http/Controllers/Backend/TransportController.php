<?php

namespace App\Http\Controllers\Backend;

use App\Model\Product;
use App\Model\Transport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TransportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = DB::table('transports as t')
            ->leftJoin('product_many_services as ps', 't.id', '=', 'ps.service_id')
            ->leftJoin('products as p', 'p.id', '=', 'ps.product_id')
            ->select('t.id', 't.name', 't.price', 'p.name as product_name')
            ->where('t.status', '!=', '0')->latest('t.created_at')->paginate(10);
        $product = Product::where('status', '=', '1')->get();
        return view('backends.transport.index', compact('result', 'product'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trans = Transport::create($request->all());
        DB::table('product_many_services')->insert([
            'service_id' => $trans->id,
            'type' => 'Transporter',
            'product_id' => $request->product_id,
            'status' => '1',
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('backend.transport.index')
            ->with('success', 'Transport created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Model\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $tranfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Model\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport $transport)
    {
        $ps = DB::table('product_many_services as ps')
            ->where('ps.service_id', '=', $transport->id)->first();
        if (!isset($ps)) {
            $ps = new \stdClass();
            $ps->product_id = 0;
        }
        $product = Product::where('status', '=', '1')->get();
        return view('backends.transport.edit', compact('transport', 'ps', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transport $transport)
    {
        //dd($transport);
        $transport->update($request->all());
        DB::table('product_many_services')->updateOrInsert([
            'service_id' => $transport->id,
        ], [
            'product_id' => $request->product_id,
            'type'=>'Transports',
            'updated_at'=>Carbon::now()
        ]);
        return redirect()->route('backend.transport.index')
            ->with('success', 'Transport Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Transport $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport $transport)
    {
        $transport->status = '0';
        $transport->save();
        return redirect()->route('backend.transport.index')
            ->with('success', 'Transport Delete successfully.');
    }
}
