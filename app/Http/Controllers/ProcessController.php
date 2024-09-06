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
            'dept_id'=>'required|exist:departments,id'
        ]);
        Process::create($request->all());
        return redirect()->route('processes.index')->with('success','Process Added Successfully');
    }
}
