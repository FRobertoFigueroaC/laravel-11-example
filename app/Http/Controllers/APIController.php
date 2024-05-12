<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function __invoke()
    {
     $users = User::all();
     
     return response()->json([
      'message' => 'OK',
      'users' => $users
     ], 200);
    }
}
