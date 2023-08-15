<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BlogController;


Route::get('data', [CompanyController::class, 'getData']);
Route::post('postData', [CompanyController::class, 'postData']);


Route::resource('blogs', BlogController::class);
