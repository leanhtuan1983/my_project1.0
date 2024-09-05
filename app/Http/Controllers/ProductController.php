<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        $categories = Category::all();
        return view('products.index', compact('products','categories'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'cate_id' => 'required',
        ]);
        
        Product::create($request->all());
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
    public function update(Request $request, $id) {

        $validatedData = $request->validate([
            'name' => 'required',
            'cate_id' => 'required|exists:categories,id',    
         ]);
        // Find the product by ID and update it
        $product = Product::findOrFail($id);
        $product->update($validatedData);
        // Redirect back with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
    public function destroy($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }
}
