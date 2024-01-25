<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Expense;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseCategories = ExpenseCategory::orderBy('name', 'asc')->get();
        return view('expenseCategory', compact('expenseCategories'));
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
            'name' => 'required|unique:expense_categories',
        ]);

        $category = new ExpenseCategory();
        $category->name = $request->name;
        $category->save();
        Toastr::success('Expense Category Successfully Saved :)');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $this->validate($request,[
            'name' => 'required|unique:expense_categories,name,'.$request->id,
        ]);
        $categoryUpdate = ExpenseCategory::findOrFail($request->id)->update(['name' => $request->name]);
        if($categoryUpdate){
            Toastr::success('Expense Category Successfully Updated :)');
            return back();
        }else{
            Toastr::success('Something went wrong :(');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {

        $ExpenseCategorycheck = Expense::where('expense_category_id', $expenseCategory->id)->first();
         if(isset($ExpenseCategorycheck->expense_category_id)){
            Toastr::error('Sorry This expense category already used. Could not deleted :(');
            return redirect()->back();
        }else{
            $expenseCategory->delete();
            Toastr::success('Expense Category Successfully Deleted :)');
            return redirect()->back();
        }
    }
}
