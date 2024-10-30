<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('/user/register', 'register');
    Route::post('/user/register', 'register');
    Route::get('/', 'login');
    Route::post('/','login');
});


Route::group(['prefix'=>'employee-panel','as'=>'employee-panel.'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Employees
    Route::group(['prefix'=>'employees','as'=>'employees.'], function(){
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');
        Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('update');
        Route::get('/edit-data/{id}', [EmployeeController::class, 'edit'])->name('edit');
        Route::get('/add-employee', [EmployeeController::class, 'create'])->name('add-employee');
        Route::get('/details/{id}', [EmployeeController::class, 'details'])->name('details');
        Route::delete('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');
        Route::get ('/search', [EmployeeController::class,'search'])->name('search');
        Route::post('/check-email', [EmployeeController::class, 'checkEmail'])->name('check.email');
    });

    // users
    Route::group(['prefix'=>'users','as'=>'users.'], function(){
        Route::get('/', [UserController::class, 'index'])->name('index');

    });

    //attendance



});




