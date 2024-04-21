<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
      return view('auth.login');
    }

    public function store(Request $request)
    {
    // Validate
    $attributes = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required', Password::min(6)]
    ]);

    // this way my approach
    // Find User
    // $user = User::where('email', $request->email)->firstOrFail();
    // Authenticate
    // Auth::login($user);

    // attempts to login
    if( !Auth::attempt($attributes) ){
      throw ValidationException::withMessages([
        'email' => 'The credentials do not match'
      ]);
    }
    // regenerate the session token
    $request->session()->regenerate();

    // Redirect
    return redirect('/jobs');
    }

    public function destroy()
    {
      Auth::logout();

      return redirect('/');
      
    }
}
