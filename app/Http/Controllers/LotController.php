<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;

class LotController extends Controller
{
    public function index() {
        $lots = Lot::all();
        return view('lots.index',compact('lots'));
    }
    public function store(Request $request) {

    }
    public function update(Request $request, $id) {
        
    }
    public function destroy($id) {

    }
}
