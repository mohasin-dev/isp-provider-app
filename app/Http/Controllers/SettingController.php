<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::findOrfail(1)->first();
        return view('setting', compact('setting'));
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
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        // print_r($request->all());
        // dd();
        $cname = str_slug($request->company_name);
        if ($request->hasFile('logo')) {
            if(File::exists('images/'.$setting->logo)){
                File::delete('images/'.$setting->logo);
            }
            $image = $request->file('logo');
            $filename = $cname.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/'.$filename);
            Image::make($image)->resize(100, 100)->save($location);
            // Product::findOrFail($request->id)->update(['image' => $filename]);
            $setting->logo = $filename;
        }else{
            $setting->logo = 'isp_logo.jpg';
        }
        $setting->company_name = $request->company_name;
        $setting->phone = $request->phone;
        $setting->address = $request->address;
        $setting->save();
        Toastr::success('Settings Successfully Updated :)');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
