<?php

{/*namespace App\Http\Controllers;

use App\Models\Userimage;
use Auth;
use Illuminate\Http\Request;
use Storage;

class UserimageController {
  function read(Request $request) {
   return Auth::user()->userimage()->get();
  }

  function show (Request $request, string $id) {
    $model = Userimage::findOrFail($id); // für eingeloggte... und können alle bilder sehen
    $model = Auth::user()->userimage()->findOrFail($id);
    $file = Storage::get($model->file);
    $mime = Storage::mimeType($model->file);
    return response($file)->header('Content-Type', $mime);
  }

  function create(Request $request) {
    // kontrolle ob bereits ein bild vorhanden
    $existingImage = Auth:: user()->userimage;
    if ($existingImage) {
      return response()->json(['message' => "der Benutzer hat beretis ein bild."], 400);
    }
    // wenn noch kein bild vorhanden ist, ein neues erstellen
    $payload = Userimage::validate($request);
    $model = new Userimage($payload);
    $model->user_id = Auth::id();
    // file upload
    $file = $request->file('file'); // pic.png nach ('file')
    $model->file = Storage::putFile($file);
    $model->save();
    return $model;
  }


  function replace(Request $request) {
    // überprüfen ob der benutzer bereits ein bild hat // PROBLEME MIT CACHE! Besser löschen und wieder hochladen
    $existingImage = Auth::user()->userimage;
    if($existingImage) {
      // wenn ein bild vorhanden ist, altes bild löschen und neues hinzufügen
      Storage::delete($existingImage->file);
      $payload = Userimage::validate($request);
      $existingImage->fill($payload);
      $file =  $request->file('file');
      $existingImage->file = Storage::putFile($file);
      $existingImage->save();
      return $existingImage;
    } else {
      // Wenn noch kein Bild vorhanden ist, eines kreiren
        $payload = Userimage::validate($request);
        $model = new Userimage($payload);
        $model->user_id = Auth::id();

        // Dateiupload
        $file = $request->file('file');
        $model->file = Storage::putFile($file);

        $model->save();
        return $model;
    }
}

  function delete(Request $request) {
    $id = $request->input ('id');
    $model = Auth::user()->userimage()->findOrFail($id);
    Storage::delete($model->file); // löscht das bild im Storage
    $model->delete();
   
    return $model;
  }
}*/}
