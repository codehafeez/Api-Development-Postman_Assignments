<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController; 


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user-detail', [UserController::class, 'getUser']);
});
