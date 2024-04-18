<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;



Route::get('/', function () {
    $jobs = Job::all();

    return view('home');
});

Route::get('/jobs', function (){
  $jobs = Job::with('employer')->orderBy('id', 'DESC')->simplePaginate(3);
    return view('jobs.index', [
      'jobs' => $jobs,
    ]);
});
Route::get('/jobs/create', function () {
 return view('jobs.create');
});


Route::get('/jobs/{id}', function ($id){
   
    return view('jobs.show', [
      'job' => Job::find($id)
    ]);
});
Route::post('/jobs', function() {
  // validation
  request()->validate([
    'title' => ['required', 'string', 'min:3'],
    'salary' => ['required', 'string']
  ]);

  $job = Job::create([
    'title' => request('title'),
    'salary' => request('salary'),
    'employer_id' => 1,
  ]);
  return redirect('/jobs/'.$job->id);
});


Route::get('/contact', function () {
    return view('contact');
});
