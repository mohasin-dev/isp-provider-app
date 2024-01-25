<?php

namespace App\Http\Controllers;

use App\Inventory;
use Illuminate\Http\Request;
use App\Suplier;
use App\Product;
use App\SupplierTransection;
use Carbon\Carbon;
use App\SupplierTransectionHistory;
use App\Expense;
use Illuminate\Support\Facades\Input;
use App\InventoryHistory;
use Brian2694\Toastr\Facades\Toastr;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supliers = Suplier::all();
        $products = Product::all();
        return view('inventory', compact('supliers', 'products'));
    }

    public function productList(Request $request)
    {
      //$vendor = $_POST['vendor'];
      $suplier = $request->suplier;
      $value = Product::all()->where('suplier_id',$suplier);
      echo $value;
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
        //$input = Input::all();
        //print_r($input);
        //print_r($request->all());
        //dd();

        $SupplierTransection = SupplierTransection::insert([
            'supplier_id' => $request->suplier_id,
            'invoice_id' => $request->invoice_id,
            'total_cost' =>   $request->total_cost,
            'amount_paid'=> $request->amount_paid,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        $SupplierTransectionHistory = SupplierTransectionHistory::insert([
            'supplier_id' => $request->suplier_id,
            'invoice_id' => $request->invoice_id,
            'from_where' => $request->from_where,
            'amount_paid'=> $request->amount_paid,
            'created_at' => Carbon::now()->toDateTimeString()
          ]);
        // //echo $SupplierTransectionHistory;
        $supplierName = Suplier::find($request->suplier_id);
        if($request->from_where == 1)
            {
            $expensesTable = Expense::insert([
                'expense_category_id' => 2,
                'amount' => $request->amount_paid,
                'reason' => $supplierName->name,
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
        }
        //echo $expensesTable;

        // if ($request->hasFile('attach_file')) {
        //     $path = $request->file('attach_file')->store('expenses_file');
        //     $addInvoiceFile = Inventory::where('product_id', $request->product_id[$key])->increment(
        //         'quantity',$request->quantity[$key]);
        // }

        foreach ( $request->product_id  as  $key => $value) {

        //echo $value;
        //echo "<br>";
        //echo $request->product_id[$key];
        //echo $_POST['quantity'][$key];
        //echo $request->quantity[$key];
        //echo "<br>";

        $updateInventory = Inventory::where('product_id', $request->product_id[$key])->increment(
            'quantity',$request->quantity[$key]);

            if($updateInventory){
            $InventoryHistory = InventoryHistory::insert([
                'product_id' =>$request->product_id[$key],
                'quantity' =>   $request->quantity[$key],
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
            }
        }
        //Session::flash('bookAdded', "Products added Successfully Added!");
        Toastr::success('Product Quantity Successfully Added :)');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
