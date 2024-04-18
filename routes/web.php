<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;



Route::view('/', 'home');
Route::view('/contact', 'contact');
// Resource
Route::resource('jobs', JobController::class);
