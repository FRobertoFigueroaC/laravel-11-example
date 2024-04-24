<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

  public function store(Request $request)
  {
    // validation
    $request->validate([
      'title' => ['required', 'string', 'min:3'],
      'salary' => ['required', 'string']
    ]);

    

    $job = Job::create([
      'title' => request('title'),
      'salary' => request('salary'),
      'employer_id' => Auth::user()->employers[0]->id,
    ]);
    Mail::to($job->employer->user)->send(new JobPosted($job));
    return redirect('/jobs/' . $job->id);
  }

  public function edit(Job $job)
  {
    
    if (Auth::guest()) {
      return redirect('/login');
    }
    //Using gate
    // Gate::authorize('edit-job', $job);

    // Using can
    // if (Auth::user()->cannot('edit-job', $job)) {
    //   dd('fail');
    // }

    return view('jobs.edit', ['job' => $job]);
  }


  public function update(Job $job, Request $request)
  {
    // Validate
    $request->validate([
      'title' => ['required', 'string', 'min:3'],
      'salary' => ['required', 'string']
    ]);
    // authorize (on hold)
    Gate::authorize('edit-job',
      $job
    );
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
    Gate::authorize('edit-job',
      $job
    );
    // delete the job
    $job->delete();
    //redirect
    return redirect('/jobs');
  }
}
