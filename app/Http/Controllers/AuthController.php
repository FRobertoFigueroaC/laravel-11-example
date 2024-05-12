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
        'email' => ['required', 'email'],
        'password' => ['required', Password::min(6)]
      ]);

      // attempts to login
      if (!Auth::attempt($attributes)) {
        $this->error('The credentials do not match', 401);
      }
      $user = User::where('email', $request['email'])->first();
      $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

      $response = $request->toArray();
      return $this->okWithData([
      'token' => $token
      ]);
    }
}
