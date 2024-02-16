<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Storage;

class UserController {

  function read (Request $request){
    return Auth::user();

}


function show (Request $request){
  $query = User::query();
  return $query->get();
}

function update(Request $request) {
  $model = Auth::user();
  $payload = User::validate($request);

  $data = [
    'email' => $request->input('email'),
  ];
  if ($request->filled('password')) {
    $data['data'] = Hash::make($request->input('password'));
  }

  if ($request->hasFile('userimage_URL')) {
    // Das bestehende Bild löschen, falls vorhanden
    if ($model->userimage_URL) {
      $imagePath = str_replace(asset('storage/'), 'public/', $model->userimage_URL);
      if (Storage::exists($imagePath)) {
        Storage::delete($imagePath);
      }
    }

  // if ($request->hasFile('userimage_URL')) {
    $image = $request->file('userimage_URL');
    $imageName = uniqid() . '_' . $image->getClientOriginalName();
    $image->storeAs('public/images', $imageName);
    $data['userimage_URL'] = asset('storage/images/' . $imageName);
  }
  
  $model->update($data);
  return $model;
}



function delete(Request $request) {
  $user = Auth::user();
  $user->comments()->delete();
  $user->tips()->delete();
  $user->delete();
  return $user;
  }


}