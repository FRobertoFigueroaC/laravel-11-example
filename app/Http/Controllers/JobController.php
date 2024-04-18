<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
  public function index()
  {
    $jobs = Job::with('employer')->orderBy('id', 'DESC')->simplePaginate(3);
    return view('jobs.index', ['jobs' => $jobs]);
  }

  public function show(Job $job)
  {
    return view('jobs.show', ['job' => $job]);
  }

  public function create(Job $job)
  {
    return view('jobs.create');
  }

  public function store()
  {
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
    return redirect('/jobs/' . $job->id);
  }

  public function edit(Job $job)
  {
    return view('jobs.edit', ['job' => $job]);
  }

  public function update(Job $job)
  {
    // Validate
    request()->validate([
      'title' => ['required', 'string', 'min:3'],
      'salary' => ['required', 'string']
    ]);
    // authorize (on hold)
    // update the job
    // $job->title = request('title');
    // $job->salary = request('salary');
    // $job->save();

    $job->update([
      'title' => request('title'),
      'salary' => request('salary')
    ]);

    // redirect to the job page
    return redirect('/jobs/' . $job->id);
  }

  public function destroy(Job $job)
  {
    // authorize (on hold)
    // delete the job
    $job->delete();
    //redirect
    return redirect('/jobs');
  }
}
