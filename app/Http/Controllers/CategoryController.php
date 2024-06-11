<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categories.index')->with([
            'title' => 'Categories',
            'data' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create')->with([
            'title' => 'Create Category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories',
        ]);

        Category::create([
            'category_name' => Str::title($request->category_name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit')->with([
            'title' => 'Edit Category',
            'data' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if($category->update([
            'category_name' => Str::title($request->category_name)
        ])) {
            return redirect()->route('categories.index')->with('success', 'Category has been updated');
        }
        return back()->with('error', 'Category not updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->delete()) {
            return redirect()->route('categories.index')->with('success', 'Category has been deleted');
        }
        return back()->with('error', 'Category not deleted');
    }
}
