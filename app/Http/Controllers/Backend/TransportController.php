<?php

namespace App\Http\Controllers\Backend;

use App\Model\Transport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $result = Transport::where('status','!=','0')->latest()->paginate(10);
        return view('backends.transport.index',compact('result'));
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
        Transport::create($request->all());
        return redirect()->route('backend.transport.index')
            ->with('success','Transport created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $tranfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport $transport)
    {
        return view('backends.productTypes.edit',compact('transport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transport $transport)
    {
        $transport->update($request->all());
        return redirect()->route('backend.transport.index')
            ->with('success','Transport Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport $transport)
    {
        $transport->status = '0';
        $transport->save();
        return redirect()->route('backend.transport.index')
            ->with('success','Transport Delete successfully.');
    }
}
