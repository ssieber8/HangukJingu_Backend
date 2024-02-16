<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Auth;
use Illuminate\Http\Request;

class CommentsController {
  function read(Request $request) {
    $query = Comment::query();
    // $query = Auth::user()->comments();
    return $query->get();
  }

  function create(Request $request) {
    $payload = Comment:: validate($request, isNew: true);
    // $model = new Comment($payload); // löschen
    $model = Auth::user()->comments()->make($payload);
    $model->save();
    return $model;
  }

  function update(Request $request) {
    $id = $request->input('id');
    $payload = Comment::validate($request);
    // $model = Comment::findOrFail($id); // löschen
    $model = Auth::user()->comments()->findOrFail($id);
    $model->fill($payload); 
    $model->save();
    // return $model;
    return response()->json($model, 200);
  }

  function delete(Request $request) {
    $id = $request->input('id');
    // $model = Comment::findOrFail($id); // löschen
    $model = Auth::user()->comments()->findOrFail($id);
    $model->delete();
    return $model;
  }

}

