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

// Create
Route::get('/jobs/create', function () {
 return view('jobs.create');
});

// Show
Route::get('/jobs/{id}', function ($id){
    return view('jobs.show', [
      'job' => Job::find($id)
    ]);
});

// Store
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

// Edit
Route::get('/jobs/{id}/edit', function ($id) {

  return view('jobs.edit', [
    'job' => Job::find($id)
  ]);
});
// Update
Route::patch('/jobs/{id}', function ($id) {
  // Validate
  request()->validate([
    'title' => ['required', 'string', 'min:3'],
    'salary' => ['required', 'string']
  ]);
  // authorize (on hold)
  // update the job
  $job = Job::findOrFail($id);
  // $job->title = request('title');
  // $job->salary = request('salary');
  // $job->save();

  $job->update([
    'title' => request('title'),
    'salary' => request('salary')
  ]);
  
  // redirect to the job page
  return redirect('/jobs/'.$job->id);
});
// Destroy
Route::delete('/jobs/{id}', function ($id) {

  // authorize (on hold)
  // delete the job
  Job::findOrFail($id)->delete();
  //redirect
  return redirect('/jobs');

});


Route::get('/contact', function () {
    return view('contact');
});
