<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\Procedure;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\ProcedureProcess;
use Illuminate\Support\Facades\DB;
use NunoMaduro\Collision\Provider;

class ProcedureController extends Controller
{
    public function index() {
        $procedures = Procedure::all()->groupBy('name')->map(function ($group)
        {
            return $group->first(); // Lấy dòng đầu tiên của mỗi nhóm
        });
        $procedureItems = Procedure::all();
        $processes = Process::all()->groupBy('dept_id');
        $departments = Department::all();
    
        return view('procedures.index', compact('procedures','processes','departments','procedureItems'));
    }
    public function show($name) {
        $procedureDetails = DB::table('procedures')
        ->join('processes', 'procedures.process_id', '=', 'processes.id')
        ->join('departments','processes.dept_id','=','departments.id')
        ->select('procedures.name as procedure_name', 'processes.name as process_name', 'processes.description as description','departments.name as dept_name')
        ->where('procedures.name', $name)
        ->orderBy('procedures.name')
        ->get()
        ->groupBy('procedure_name'); // Nhóm theo procedure_name

    return view('procedures.show', compact('procedureDetails'));
    }
    public function store(Request $request) {

      // Validate dữ liệu từ request
      $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'process_id' => 'required|array', // Yêu cầu process_id là một mảng
        ]);

    // Lưu từng process_id cùng với name và description
    foreach ($validated['process_id'] as $processId) {
        Procedure::create([
        'name' => $validated['name'], // Lấy tên từ request đã validate
        'description' => $validated['description'], // Lấy description từ request đã validate
        'process_id' => $processId, // Lưu từng process_id từ mảng process_id
        ]);
    }

    // Trả về thông báo thành công
    return redirect()->back()->with('success', 'Procedure saved successfully!');
    }
    public function edit($name) {

        $procedure = Procedure::where('name', $name)->firstOrFail();
        return view('procedures.edit',compact('procedure'));
    }
    public function update(Request $request, $name)
    {
        // Validate dữ liệu từ request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'process_id' => 'required|array', // Yêu cầu process_id là một mảng
            ]);

            // Tìm các Procedure hiện tại theo $id và cập nhật name, description
        $procedure = Procedure::findOrFail($name);
        $procedure->update([
            'name' => $validated['name'], // Cập nhật tên
            'description' => $validated['description'], // Cập nhật description
            ]);

        // Cập nhật process_id
        // Xóa các process_id cũ (nếu có), sau đó thêm các process_id mới
        Procedure::where('name', $name)->delete(); // Xóa các process_id cũ theo $id

        // Lưu từng process_id cùng với name và description đã cập nhật
        foreach ($validated['process_id'] as $processId) {
        Procedure::create([
            'name' => $validated['name'], // Lấy tên từ request đã validate
            'description' => $validated['description'], // Lấy description từ request đã validate
            'process_id' => $processId, // Lưu từng process_id từ mảng process_id
        ]);
    }
dd($request);
    return redirect()->route('procedures.index')->with('success', 'Cập nhật thành công!');
}

}
