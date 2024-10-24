<?php

namespace App\Http\Controllers;

use App\Models\employee_model;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function search(Request $request){
        $search = $request->input("search");
        $query = $request->input("query");
        $query = $query ? $query : $search;
    }

    public function show(){
        return view('employee.employeeList');
    }
}
