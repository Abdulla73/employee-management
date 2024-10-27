<?php

namespace App\Http\Controllers;

use App\Models\employee_model;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        return view('dashboard.index');
    }
}
