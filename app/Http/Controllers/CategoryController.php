<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'desc')->get();
        return view('category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('category.create');
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
            'name' => 'required|unique:categories',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        Toastr::success('Category Successfully Saved :)');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //echo $category;
        //print_r($request->all());
        $this->validate($request,[
            'name' => 'required|unique:categories,name,'.$request->id,
        ]);
        $categoryUpdate = Category::findOrFail($request->id)->update(['name' => $request->name]);
        if($categoryUpdate){
            Toastr::success('Category Successfully Updated :)');
            return back();
        }else{
            Toastr::success('Something went wrong :(');
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Toastr::success('Category Successfully Deleted :)');
        return redirect()->back();
    }
}
