<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function search(Request $request){
        $search = $request->input("search");
        $query = $request->input("query");
        $query = $query ? $query : $search;
    }

    public function index()
    {
        $employees = employee::all();
        return view('employee.employes', compact('employees'));
    }
}
