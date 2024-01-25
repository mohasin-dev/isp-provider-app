<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Feature;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Feature::all();
        $packages = Package::orderBy('price', 'asc')->get();
        return view('package', compact('features','packages'));
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
            'title' => 'required',
            'features' => 'required',
            'price' => 'required|numeric',
        ]);

        $package = new Package();
        $package->title = $request->title;
        $package->price = $request->price;
        $package->save();
        //echo $package;
        $package->features()->attach($request->features);

        Toastr::success('Package Successfully Saved :)','Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
         //print_r($request->all());
         //dd();
        $this->validate($request,[
            'title' => 'required|unique:packages,title,'.$request->id,
            'feature_id' => 'required',
            'price' => 'required|numeric',
        ]);
        $packageUpdate = Package::findOrFail($request->id)->update([
            'title' => $request->title,
            'price' => $request->price
            ]);
            if($packageUpdate){
                $aa = DB::table('feature_package')
                ->where('package_id', $request->id)
                ->delete();
                echo $aa;

                if($aa){
                    if(count($request->feature_id) > 0){
                        foreach($request->feature_id as $key => $value){
                            $ar = array(
                            "feature_id" => $value,
                            "package_id" => $request->id,
                            'created_at' => Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon::now()->toDateTimeString()
                            );
                            $bb = DB::table('feature_package')->insert($ar);
                        }

                        if($bb){
                            Toastr::success('Package Successfully Updated :)');
                            return back();
                        }else{
                            Toastr::success('Something went wrong :(');
                            return back();
                        }
                    }
                }
                // $packagedetails = Package::findOrFail($request->id)->first();
                // echo $packagedetails;
                // $featureUpdate = $packagedetails->features()->sync($request->features);
                // print_r($featureUpdate);
            }else{
                Toastr::success('Something went wrong :(');
                return back();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();
        Toastr::success('Package Successfully Deleted :)');
        return redirect()->back();
    }
}
