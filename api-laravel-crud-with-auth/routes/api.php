<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController; 
use App\Http\Controllers\Api\LeaguesController; 


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::post('forgotPassword', [UserController::class, 'forgotPassword']);
Route::post('changePassword', [UserController::class, 'changePassword']);


Route::get('leagues', [LeaguesController::class, 'index']);
Route::post('league', [LeaguesController::class, 'store']);
Route::get('league/{id}', [LeaguesController::class, 'show']);
Route::post('league_update/{id}', [LeaguesController::class, 'update']);
Route::get('league_delete/{id}', [LeaguesController::class, 'destroy']);