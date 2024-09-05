<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index',compact('categories'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        
        Category::create($request->all());
         
        return redirect()->route('categories.index')
                        ->with('success','Category created successfully.');
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required|in:active,disable',    
         ]);
        // Find the category by ID and update it
        $category = Category::findOrFail($id);
        $category->update($validatedData);
        // Redirect back with a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }
    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category deleted successfully');
    }
}
