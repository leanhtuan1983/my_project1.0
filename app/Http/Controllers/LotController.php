<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Product;
use Illuminate\Http\Request;

class LotController extends Controller
{
    public function index() {
        $lots = Lot::all();
        $products = Product::all();
        return view('lots.index',compact('lots','products'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'product_id' => 'required|exists:products,id',
        ]);
        
        Lot::create($request->all());
        return redirect()->route('lots.index')
                        ->with('success','Lot created successfully.');
    }
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required',
            'product_id' => 'required|exists:categories,id',    
         ]);
        // Find the lot by ID and update it
        $lot = Lot::findOrFail($id);
        $lot->update($validatedData);
        // Redirect back with a success message
        return redirect()->route('lots.index')->with('success', 'Lot updated successfully!');
    }
    public function destroy($id) {
        $lot = Lot::findOrFail($id);
        $lot->delete();
        return redirect()->route('lots.index')->with('success','Lot deleted successfully');
    }
}
