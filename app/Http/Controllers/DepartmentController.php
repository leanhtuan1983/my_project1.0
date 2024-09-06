<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::all();
        return view('departments.index',compact('departments'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        Department::create($request->all());
         
        return redirect()->route('departments.index')
                        ->with('success','Department created successfully.');
    }
    public function update(Request $request, $id) {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',    
         ]);
        // Find the category by ID and update it
        $department = Department::findOrFail($id);
        $department->update($validatedData);
        // Redirect back with a success message
        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }
    public function destroy($id) {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route('departments.index')->with('success','Department deleted successfully');
    }
}
