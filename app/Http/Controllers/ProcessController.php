<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Process;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    public function index() {
        $processes = Process::all();
        $departments = Department::all();
        return view('processes.index', compact('processes','departments'));
    }
    public function store(Request $request) {
        $request -> validate([
            'name'=>'required',
            'description' =>'required',
            'dept_id'=>'required'
        ]);
        Process::create($request->all());
        return redirect()->route('processes.index')->with('success','Process Added Successfully');
    }
    public function update(Request $request, $id) {

        $validatedData = $request->validate([
            'name' => 'required',
            'description' =>'required',
            'dept_id' => 'required|exists:departments,id',    
         ]);
        // Find the product by ID and update it
        $process = Process::findOrFail($id);
        $process->update($validatedData);
        // Redirect back with a success message
        return redirect()->route('processes.index')->with('success', 'Process updated successfully!');
    }
}
