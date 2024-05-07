<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


Route::get('test', function (){
  $job = Job::first();

  TranslateJob::dispatch($job);

  return 'Done';
});


Route::view('/', 'home');
Route::view('/contact', 'contact');
// Job Resource
// Route::resource('jobs', JobController::class)->only(['index','show']);
// Route::resource('jobs', JobController::class)->except(['index', 'show'])->middleware('auth');
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
  ->middleware('auth')
  ->can('edit','job');

Route::patch('/jobs/{job}', [JobController::class, 'update'])
  ->middleware('auth')
  ->can('edit-job', 'job');

Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
  ->middleware(['auth', 'can:edit-job, job']);




// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
// Login
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
