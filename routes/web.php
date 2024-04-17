<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;



Route::get('/', function () {
    $jobs = Job::all();

    return view('home');
});

Route::get('/jobs', function (){
  $jobs = Job::with('employer')->orderBy('id', 'DESC')->simplePaginate(3);
    return view('jobs', [
      'jobs' => $jobs,
    ]);
});
Route::get('/jobs/{id}', function ($id){
   
    return view('job', [
      'job' => Job::find($id)
    ]);
});
Route::get('/contact', function () {
    return view('contact');
});
