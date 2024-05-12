<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/testAPI', APIController::class);
Route::post('/login', [AuthController::class, 'login']);
