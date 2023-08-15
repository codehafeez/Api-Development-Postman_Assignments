<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;


Route::get('getDataAll', [CompanyController::class, 'getDataAll']);
Route::get('getData/{id}', [CompanyController::class, 'getData']);
Route::get('deleteData/{id}', [CompanyController::class, 'deleteData']);

Route::post('addData', [CompanyController::class, 'addData']);
Route::post('updateData/{id}', [CompanyController::class, 'updateData']);

