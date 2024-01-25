<?php

namespace App\Http\Controllers;

use App\Damage;
use Illuminate\Http\Request;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use App\Inventory;
use Illuminate\Support\Facades\Auth;

class DamageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Inventory::all()->where('quantity','>',0);
        $damages = Damage::orderBy('id', 'desc')->get();
        return view('damage', compact('damages', 'products'));
        //echo $products;
    }


    public function quantityCheck(Request $request)
    {
       //$value = $_POST['product_id'];
       //$value = $request->product_id;

        $productQuantity = Inventory::where('product_id',  $request->product_id)->first();
        echo $productQuantity->quantity;
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
        $checkQuantity = Inventory::where('product_id', $request->product_id)->firstOrFail()->quantity;
        if($checkQuantity >= $request->quantity){
            $decrementInventory = Inventory::where('product_id', $request->product_id)->decrement('quantity' , $request->quantity);
            $damage = new Damage();
            $damage->product_id = $request->product_id;
            $damage->quantity = $request->quantity;
            $damage->reason = $request->reason;
            $damage->issued_by = Auth::user()->id;
            $damage->save();
            Toastr::success('Damage Product Successfully Saved :)');
            return back();
        }else{
            Toastr::error('Sorry! Damage Quantity is larger then Stock Quantity :(');
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function show(Damage $damage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function edit(Damage $damage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Damage $damage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Damage $damage)
    {
        //
    }
}
