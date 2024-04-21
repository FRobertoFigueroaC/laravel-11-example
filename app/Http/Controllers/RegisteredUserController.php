<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
      return view('auth.register');
    }

    public function store(Request $request)
    {
    // Validate
    $attributes = $request->validate([
      'first_name' => ['required', 'string', 'min:3'],
      'last_name' => ['required', 'string', 'min:2'],
      'email' => ['required', 'email'],
      'password' => ['required', 'confirmed', Password::min(3)->max(20)->letters()->numbers()]
    ]);

      // Create user
      $user = User::create($attributes);

      // Authenticate
      Auth::login($user);

      // Redirect

      return redirect('/jobs');
      
    }
}
