<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Customer;
use App\Inventory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newInvoice = 1;
        $customers = Customer::all();
        $products = Inventory::all()->where('quantity','>',0);
        return view('order', compact('customers', 'products', 'newInvoice'));
    }


    public function productInfo(Request $request)
    {
        //$bookName = $_POST['bookName'];
        $productInfo = Inventory::all()->where('product_id',$request->product_id);
        echo $productInfo;
    }

    public function tempOrder(Request $request)
    {
        //$userId = Auth::id();

        // $bookID = $_POST['bookID'];
        // $bookName = $_POST['bookName'];
        // $bookQuantity= $_POST['bookQuantity'];
        // $bookPrice= $_POST['bookPrice'];
        // $total_price= $_POST['total_price'];
        // $bookPercentage= $_POST['bookPercentage'];
        // $net_price= $_POST['net_price'];
        // $customerID= $_POST['customerID'];
        // $invoice= $_POST['invoice'];

        $temporary = Order::insertGetId([
            'user_id'=> Auth::id(),
            'customer_id'=> $request->customer_id,
            'product_id'=> $request->product_id,
            'product_name'=> $request->product_name,
            'quantity'=> $request->quantity,
            'unit_price'=> $request->unit_price,
            'total_price'=> $request->total_price,
            'product_discount'=> $request->product_discount,
            'net_price'=> $request->net_price,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        Inventory::where('product_id',$request->product_id)->decrement('quantity', $request->quantity);
        echo $temporary;
    }


    public function deleteTempOrder(Request $request)
    {
        //$rowID = $_POST['temp'];
        $TempOrder = Order::find($request->temp);

        $inventory = Inventory::where('product_id', $TempOrder->product_id)->increment('quantity', $TempOrder->quantity);
        $deleteTempOrder = Order::find($request->temp)->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customerStore(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        Toastr::success('customer Successfully Saved :)');
        return back();
    }
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
