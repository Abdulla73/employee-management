<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('/user/register', 'register');
    Route::post('/user/register', 'register');
    Route::get('/', 'login');
    Route::post('/','login');
});

Route::controller(EmployeeController::class)->group(function(){
    Route::get('/employee-management/Dashboard', 'show');
});

