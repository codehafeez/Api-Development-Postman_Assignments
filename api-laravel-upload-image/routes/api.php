<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImageController;



Route::post('image',[ImageController::class, 'imageStore']);
