<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

  use ApiResponses;

    public function login(Request $request){
    $attributes = $request->validate([
        'email' => 'required | email',
        'password' => ['required', Password::min(6)]
      ]);

      // attempts to login
      if (!Auth::attempt($attributes)) {
       return  $this->error('The credentials do not match', 401);
      }
      $user = User::where('email', $request['email'])->first();
      $token = $user->createToken($user->first_name.'-AuthToken')->plainTextToken;

      return $this->okWithData([
      'token' => $token
      ]);
    }

    public function create(Request $request){
      // Validate
      $attributes = $request->validate([
        'first_name' => ['required', 'string', 'min:3'],
        'last_name' => ['required', 'string', 'min:2'],
        'email' => ['required', 'email'],
        'password' => ['required', 'confirmed', Password::min(3)->max(20)->letters()->numbers()]
      ]);

      // Create user
      $user = User::create($attributes);

      $token = $user->createToken($user->first_name . '-AuthToken')->plainTextToken;

      return $this->okWithData([
        'token' => $token
      ]);
      
    }
}
