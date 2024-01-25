<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::orderBy('name', 'asc')->get();
        return view('unit', compact('units'));
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
            'name' => 'required|unique:units',
        ]);

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->save();
        Toastr::success('Unit Successfully Saved :)');
        return redirect()->route('unit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $this->validate($request,[
            'name' => 'required|unique:categories,name,'.$request->id,
        ]);
        $unitUpdate = Unit::findOrFail($request->id)->update(['name' => $request->name]);
        if($unitUpdate){
            Toastr::success('Unit Successfully Updated :)');
            return back();
        }else{
            Toastr::success('Something went wrong :(');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        Toastr::success('Unit Successfully Deleted :)');
        return redirect()->back();
    }
}
