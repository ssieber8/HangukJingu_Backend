<?php


namespace App\Http\Controllers;

use App\Models\Tip;
use Auth;
use Illuminate\Http\Request;
use Log;
use Storage;

class TipsController {
  function read(Request $request) {
    $query = Tip::query();
    //$query = Auth::user()->tips();
    return $query->get();
  }

  function create(Request $request) {
    $payload = Tip:: validate($request, isNew: true);
    // $model = new Tip($payload); // löschen
    if ($request->hasFile('tipimage_URL')) {
      $image = $request->file('tipimage_URL');
      $imageName = uniqid() . '_' . $image->getClientOriginalName();
      $image->storeAs('public/images', $imageName);
      $payload['tipimage_URL'] = asset('storage/images/' . $imageName);
    }
    $model = Auth::user()->tips()->create($payload);
    // $model->saveImage($request->input('tipimage_URL')); // Neu dazugekommen
    $model->save(); // das bereits gelöscht gewesen!
    return $model;
  }


  function update(Request $request) {
    $id = $request->input('id');
    $payload = Tip::validate($request);
    // $model = Tip::findOrFail($id); // löschen
    $model = Auth::user()->tips()->findOrFail($id);

    if ($request->hasFile('tipimage_URL')) {
      if ($model->tipimage_URL) {
        $imagePath = str_replace(asset('storage/'), 'public/', $model->tipimage_URL);
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
      }
      $image = $request->file('tipimage_URL');
      $imageName = uniqid() . '_' . $image->getClientOriginalName();
      $image->storeAs('public/images', $imageName);
      $payload['tipimage_URL'] = asset('storage/images/' . $imageName);
    }
    
    // Storage::delete($model->file);
    // $file = $request->file('file');
    // $model->file = Storage::putFile('public/images', $file);
    $model->update($payload);
    return $model;

    {/*if ($request->hasFile('tipimage_URL')) {
      $image = $request->file('tipimage_URL');
      $imageName = uniqid() . '_' . $image->getClientOriginalName();
      $image->storeAs('public/images', $imageName);
      $payload['tipimage_URL'] = asset('storage/images/' . $imageName);
    }
    $model->fill($payload); 
    $model->save();
  return response()->json(['message' => 'Tip erfolgreich upgedated']);*/}
  }

  // function update(Request $request) {
  //   $id = $request->input('id');
  //   $payload = Tip::validate($request);
  //   // $model = Tip::findOrFail($id); // löschen
  //   $model = Auth::user()->tips()->findOrFail($id);
  //   $model->fill($payload); 
  //   $model->save();
  //   return $model;
  // }

  

  function delete(Request $request) {
    $id = $request->input('id');
    // $model = Tip::findOrFail($id); // löschen
    $model = Auth::user()->tips()->findOrFail($id);
    $model->delete();
    return $model;
  }

}

