<?php

{/*namespace App\Http\Controllers;

use App\Models\Tip;
use App\Models\Tipimage;
use Auth;
use Illuminate\Http\Request;
use Storage;

class TipimageController {
  function read(Request $request) {
    $tipimage = Tipimage::all();

    return $tipimage;
  }

  function show (Request $request, string $id) {
    $model = Tipimage::findOrFail($id); // für eingeloggte... und können alle bilder sehen
    $model = Auth::user()->tipimage()->findOrFail($id);
    $file = Storage::get($model->file);
    $mime = Storage::mimeType($model->file);
    return response($file)->header('Content-Type', $mime);
  }

  function create(Request $request) {
    // Tip-ID aus dem request erhalten
    $id = $request->input('tip_id');
    // Tip mit Beziehung zum Bild abrufen
    $tip = Tip::with('tipimage')->find($id);
    // Überprüfen ob der tip existiert
    if (!$tip) {
      return response()->json(['message' => "Der Tip mit der ID $id existiert nicht."], 400);
    }
    // Überprüfen ob bereits ein bild zum tip existiert
    $existingImage = $tip->tipimage;
    if($existingImage) {
      return response()->json(['message' => "der Tip hat beretis ein bild."], 400);
    }
    // validierung der Bildinfos
    $payload = Tipimage::validate($request);
    // überprüfen ob die datei erfolgreich geladen wurde
    if ($request->hasFile('file') && $request->file('file')->isValid()) {
      // Bild erstellen und mit tip verknüpfen
      $tipimage = $tip->tipimage()->create([
        'file' => Storage::putFile($request->file('file')),
      ]);
      return $tipimage;
    } else {
      return response()->json(['message' => "Fehler beim Dateiupload"], 500);
    }
  }


  function replace(Request $request) {
    // Tip-ID aus dem request erhalten
    $id = $request->input('tip_id');
    // Tip mit Beziehung zum Bild abrufen
    $tip = Tip::with('tipimage')->find($id);
    // Überprüfen ob der tip existiert
    if (!$tip) {
      return response()->json(['message' => "Der Tip mit der ID $id existiert nicht."], 400);
    }
    // überprüfen ob der tip bereits ein bild hat // PROBLEME MIT CACHE! Besser löschen und wieder hochladen
    $existingImage = $tip->tipimage;
    if($existingImage) {
      // wenn ein bild vorhanden ist, altes bild löschen und neues hinzufügen
      Storage::delete($existingImage->file);
      $payload = Tipimage::validate($request);
      $existingImage->fill($payload);
      $file =  $request->file('file');
      $existingImage->file = Storage::putFile($file);
      $existingImage->save();
      return $existingImage;
    } else {
      // Wenn noch kein Bild vorhanden ist, eines kreiren
        $payload = Tipimage::validate($request);
        $model = new Tipimage($payload);
        $model->tip_id = Auth::id();

        // Dateiupload
        $file = $request->file('file');
        $model->file = Storage::putFile($file);

        $model->save();
        return $model;
    }
}

  function delete(Request $request) {
      // Tip-ID aus dem request erhalten
  $id = $request->input('tip_id');
  // Tip mit Beziehung zum Bild abrufen
  $tip = Tip::with('tipimage')->find($id);
  // Überprüfen ob der tip existiert
  if (!$tip) {
    return response()->json(['message' => "Der Tip mit der ID $id existiert nicht."], 400);
  }
  // überprüfen ob der tip bereits ein bild hat // PROBLEME MIT CACHE! Besser löschen und wieder hochladen
  $existingImage = $tip->tipimage;
  if($existingImage) {
    // wenn ein bild vorhanden ist, altes bild löschen
    Storage::delete($existingImage->file);
    $existingImage->delete();
    return $existingImage;
  }
  }
}*/}