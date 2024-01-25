<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Suplier;
use App\Category;
use App\Inventory;
use Carbon\Carbon;
use Image;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suplers = Suplier::all();
        $categories = Category::all();
        $products = Product::all();
        return view('product', compact('suplers','products','categories'));
        //echo $products;
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
            'name' => 'required',
            'image' => 'image',
        ]);

        $image = $request->file('image');
        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/product/'.$filename);
            Image::make($image)->resize(100, 100)->save($location);
        }else{
            $filename = 'product.png';
        }

        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->suplier_id = $request->suplier_id;
        $product->category_id = $request->category_id;
        $product->image = $filename;
        $product->save();
        $product_id = $product->id;
        if($product_id){
            $inventory = new Inventory();
            $inventory->product_id = $product_id;
            $inventory->quantity = 0;
            $inventory->alert_quantity = $request->alert_quantity;
            $inventory->unit_price = $request->unit_price;
            $inventory->discount = $request->discount;
            $inventory->save();
            $inventory_id = $inventory->id;
            //echo $inventory_id;
            //dd();
        if($inventory_id){
        return redirect()->route('product.index');
        }
        else{
            Toastr::success('Something Gone Wrong Inventorie add! :(');
            return back();
        }
       }
       else {
            Toastr::success('Something Gone Wrong Inventorie add! :(');
            return back();
       }
        Toastr::success('product Successfully Saved :)');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //print_r($request->all());
        //echo $product->id;
        //echo $request->id;
        //dd();
        $this->validate($request,[
            'unit_price' => 'required',
            'alert_quantity' => 'required',
            'image' => 'image'
        ]);
        $productImage = Product::findOrFail($request->id);
        //echo $productImage->image;
        //dd();
        $currentDate = Carbon::now()->toDateString();
        if ($request->hasFile('image')) {
            if(File::exists('images/product/'.$productImage->image)){
                File::delete('images/product/'.$productImage->image);
            }
            $image = $request->file('image');
            $filename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/product/'.$filename);
            Image::make($image)->resize(100, 100)->save($location);
            Product::findOrFail($request->id)->update(['image' => $filename]);
        }

        $InventoryeUpdate = Inventory::where('product_id',$request->id)->update([
            'alert_quantity' => $request->alert_quantity,
            'unit_price' => $request->unit_price
            ]);
        if($InventoryeUpdate){
        Toastr::success('Product Successfully Updated :)');
        return back();
        }else{
        Toastr::success('Something went wrong :(');
        return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $productQuantitycheck = Inventory::where('product_id', $product->id)->first();
         if($productQuantitycheck->quantity == 0){
            $deleteFromInventory = Inventory::where('product_id', $product->id)->delete();
            if($deleteFromInventory){
                $product->delete();
                Toastr::success('Product Successfully Deleted :)');
                return redirect()->back();
            }
         }else{
            Toastr::Error('Sorry this product in stock, could not Deleted :(');
            return redirect()->back();
         }

    }
}
