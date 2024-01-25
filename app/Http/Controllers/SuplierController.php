<?php

namespace App\Http\Controllers;

use App\Suplier;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supliers = Suplier::orderBy('name', 'asc')->get();
        return view('suplier', compact('supliers'));
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
            'name' => 'required|unique:supliers',
        ]);

        $suplier = new Suplier();
        $suplier->name = $request->name;
        $suplier->email = $request->email;
        $suplier->phone = $request->phone;
        $suplier->address = $request->address;
        $suplier->note = $request->note;
        $suplier->save();
        Toastr::success('suplier Successfully Saved :)');
        return redirect()->route('suplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function show(Suplier $suplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Suplier $suplier)
    {
        //return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suplier $suplier)
    {
        //echo $suplier;
        $this->validate($request,[
            'name' => 'required|unique:supliers,name,'.$request->id,
        ]);
        $suplierUpdate = Suplier::findOrFail($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            ]);
        if($suplierUpdate){
            Toastr::success('Suplier Successfully Updated :)');
            return back();
        }else{
            Toastr::success('Something went wrong :(');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suplier $suplier)
    {
        $suplier->delete();
        Toastr::success('Suplier Successfully Deleted :)');
        return redirect()->back();
    }
}
