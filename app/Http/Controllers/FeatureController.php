<?php

namespace App\Http\Controllers;

use App\Feature;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Feature::orderBy('name', 'asc')->get();
        return view('Feature', compact('features'));
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
        $this->validate($request,[
            'name' => 'required|unique:features',
        ]);

        $feature = new Feature();
        $feature->name = $request->name;
        $feature->save();
        Toastr::success('Feature Successfully Saved :)');
        return redirect()->route('feature.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
        $this->validate($request,[
            'name' => 'required|unique:features,name,'.$request->id,
        ]);
        $featureUpdate = Feature::findOrFail($request->id)->update(['name' => $request->name]);
        if($featureUpdate){
            Toastr::success('Feature Successfully Updated :)');
            return back();
        }else{
            Toastr::success('Something went wrong :(');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();
        Toastr::success('Feature Successfully Deleted :)');
        return redirect()->back();
    }
}
