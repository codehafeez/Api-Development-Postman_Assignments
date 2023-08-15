<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;

Route::get('addEmployee', [EmployeeController::class, 'addEmployee']);
Route::get('addSalary', [SalaryController::class, 'addSalary']);

Route::get('getData', [EmployeeController::class, 'getData']);
Route::get('getDataJoin', [EmployeeController::class, 'getDataJoin']);
Route::get('getDataHasOne', [EmployeeController::class, 'getDataHasOne']);

    