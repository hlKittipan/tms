<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $setting = Setting::all();
        return view('backends.setting.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            //dd($key);
            if ($key != '_token'){
                DB::table('system_setups')
                    ->where('code', $key)
                    ->update(['value' => $value]);
            }
        }
        return redirect()->route('backend.setup.index')
            ->with('success', 'Config successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Setting::create($request->all());
        return redirect()->route('backend.setup.index')
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Model\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Model\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        DB::table('system_setups')->where('code', '=', $code)->delete();

        return redirect()->route('backend.setup.index')
            ->with('success', 'Setting delete successfully.');
    }

}
