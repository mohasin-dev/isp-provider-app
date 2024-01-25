<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseCategories = ExpenseCategory::orderBy('name', 'asc')->get();
        $expenses = Expense::orderBy('id', 'desc')->get();
        return view('expense', compact('expenseCategories', 'expenses'));
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
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";
        $this->validate($request,[
            'expense_category_id' => 'required|numeric',
        ]);

        if ($request->hasFile('attach_file')) {
           $path = $request->file('attach_file')->store('expenses_file');
           $expense = new Expense();
           $expense->expense_category_id = $request->expense_category_id;
           $expense->amount = $request->amount;
           $expense->reason = $request->reason;
           $expense->attach_file = $path;
           $expense->save();
           Toastr::success('Expense Successfully Saved :)');
           return back();
        }else{
            $expense = new Expense();
            $expense->expense_category_id = $request->expense_category_id;
            $expense->amount = $request->amount;
            $expense->reason = $request->reason;
            $expense->save();
            Toastr::success('Expense Successfully Saved :)');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
