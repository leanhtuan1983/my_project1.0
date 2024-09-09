<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Process;
use App\Models\Procedure;
use Illuminate\Http\Request;


class ProcedureController extends Controller
{
    public function index() {
        $procedures = Procedure::all();
        $processes = Process::all()->groupBy('dept_id');
        $departments = Department::all();
    
        return view('procedures.index', compact('procedures','processes','departments'));
    }
    public function store() {
        return view('procedures.index');
    }
}
