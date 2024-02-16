<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController {
  function register (Request $request) {
    $payload = User::validate($request, isNew: true);
    $user = User::make($payload);
    $user->password = Hash::make ($user->password);
    $user->save();
    Auth::login($user); // Automatisch einlogen ... wird audentifiziert
    return $user;
  }

  function login (Request $request){
    try {
      $credentials = $request->only('username', 'password');
      if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('access_token')->plainTextToken;

        return response()->json([
          'user' => $user,
          'access_token' => $token,
        ]);
      }
      throw new \Exception('Login failed. Invalid credentials.');
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 401);
    }
    // $success = Auth::attempt([ // attempt macht schon kontrolle ob alles ok ist
    //   'username' => $request->input ('username'),
    //   'password' => $request->input ('password'),
    // ]);
    // if ($success) return Auth::user();
    // else abort (401, 'login failed');
  }

  function logout (Request $request) {
    $request->user()->tokens()->delete();
    // $user = Auth::user();
    Auth::guard('web')->logout();
    return response()->json(['message' => 'Successfully logged out']);
    // return $user;
  }

}