<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('resources', [ResourceController::class, 'index']);
Route::post('resources', [ResourceController::class, 'store']);
Route::get('resources/{resource}', [ResourceController::class, 'show']);
Route::post('resources/{resource}', [ResourceController::class, 'update']);
Route::delete('resources/{resource}', [ResourceController::class, 'destroy']);

