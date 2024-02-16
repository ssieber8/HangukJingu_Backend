<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\TipsController;
// use App\Http\Controllers\TipimageController;
use App\Http\Controllers\UserController;
use App\Models\Comment;
// use App\Http\Controllers\UserimageController;
use App\Models\Tip;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::post ('/auth/register', [AuthController::class, 'register']);
Route::post ('/auth/login', [AuthController::class, 'login']);

// Route::get ('/users/{id}', [UserController::class, 'show']);
Route::get('/users/{id}', function($id){
  $user = User::find($id);

  if($user){
    return response()->json($user);
  }else{
    return response()->json(['message'=> 'user nicht gefunden'], 404);
  }
});


          // Route::get ('/userimage', [UserimageController::class, 'read']);
          // Route::get ('/userimage/{id}', [UserimageController::class, 'show']);

Route::get ('/tips', [TipsController::class, 'read']);
Route::get('/tip/{id}', function($id){
  $tip = Tip::find($id);

  if($id){
    return response()->json($tip);
  }else{
    return response()->json(['message'=> 'Tip nicht gefunden'], 404);
  }
});


          // Route::get ('/tipimage', [TipimageController::class, 'read']);
          // Route::get ('/tipimage/{id}', [TipimageController::class, 'show']);

Route::get ('/comments', [CommentsController::class, 'read']);
Route::get('/comments/{tip_id}', function($tip_id){
  $comments = Comment::where('tip_id', $tip_id)->get();

  if($comments->count() > 0){
    return response()->json($comments);
  }else{
    return response()->json(['message'=> 'Comments zu diesem tip nicht gefunden'], 404);
  }
});
Route::get('/comment/{id}', function($id){
  $comment = Comment::find($id);

  if($comment){
    return response()->json($comment);
  }else{
    return response()->json(['message'=> 'Comment nicht gefunden'], 404);
  }
});

{/*Route::get('/comment/{user_id}', function($user_id){
  $comment = Comment::find($user_id);

  if($user_id){
    return response()->json($comment);
  }else{
    return response()->json(['message'=> 'Comment für den user nicht gefunden'], 404);
  }
});*/}


// Route::middleware('auth')->group(function() {
  Route::middleware('auth:sanctum')->post ('/auth/logout', [AuthController::class, 'logout']);
  
  Route::middleware('auth:sanctum')->get ('/user/{id}', [UserController::class, 'read']);

  Route::middleware('auth:sanctum')->patch ('/user', [UserController::class, 'update']);
  Route::middleware('auth:sanctum')->post ('/user', [UserController::class, 'update']);
  {/*Route::middleware('auth:sanctum')->post('/user', function($id){
    $user = User::find($id);
  
    if($user) {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
            'userimage_URL' => 'required',
        ]);
  
        $user->update([
            'email' => request('email'),
            'password' => request('password'),
            'userimage_URL' => request('userimage_URL'),
        ]);
  
        return response()->json(['message' => 'User erfolgreich upgedated']);
    } else {
        return response()->json(['message'=> 'User nicht gefunden'], 404);
    }
  });*/}

  Route::middleware('auth:sanctum')->delete ('/user', [UserController::class, 'delete']);
  {/*Route::middleware('auth:sanctum')->delete ('/user/{id}', function($id) {
    $user = User::find($id);

    if($user) {
      $user->delete();
      return response()->json(['message' => 'User erfolgreich gelöscht']);
    } else {
      return response()->json(['message' => 'User nicht gefunden'], 404);
    }
  });*/}

            // Route::middleware('auth:sanctum')->post ('/userimage', [UserimageController::class, 'create']);
            // Route::middleware('auth:sanctum')->post ('/userimage/replace', [UserimageController::class, 'replace']);
            // Route::middleware('auth:sanctum')->delete ('/userimage', [UserimageController::class, 'delete']);

  // Route::middleware('auth:sanctum')->post ('/tips', [TipsController::class, 'create']); // löschen
  // Route::middleware('auth:sanctum')->patch ('/tips', [TipsController::class, 'update']); // löschen
  // Route::middleware('auth:sanctum')->delete ('/tips', [TipsController::class, 'delete']); // löschen
Route::middleware('auth:sanctum', 'admin')-> post ('/tips', [TipsController::class, 'create']); 
// Route::middleware('auth:sanctum', 'admin')-> patch ('/tips', [TipsController::class, 'update']); 

// Route::middleware('auth:sanctum', 'admin')-> patch('/tip/{id}', [TipsController::class, 'update']);
{/*Route::middleware('auth:sanctum', 'admin')-> patch ('/tip/{id}', function($id){
  $tip = Tip::find($id);

  if($id) {
    $tip->update([
      'tip_name' => request('tip_name'),
      'tip_text' => request('tip_text'),
      'tipimage_URL' => request('tipimage_URL'),
    ]);
    return response()->json(['message' => 'Tip erfolgreich upgedated']);
  } else {
    return response()->json(['message'=> 'Tip nicht gefunden'], 404);
  }
});*/}

// Route::middleware('auth:sanctum', 'admin')-> post('/tip/{id}', [TipsController::class, 'update']);
Route::middleware(['auth:sanctum', 'admin'])->post('/tip/{id}', function($id){
  $tip = Tip::find($id);

  if($tip) {
      request()->validate([
          'tip_name' => 'required',
          'tip_text' => 'required',
          'tipimage_URL' => 'required',
      ]);

      $tip->update([
          'tip_name' => request('tip_name'),
          'tip_text' => request('tip_text'),
          'tipimage_URL' => request('tipimage_URL'),
      ]);

      return response()->json(['message' => 'Tip erfolgreich upgedated']);
  } else {
      return response()->json(['message'=> 'Tip nicht gefunden'], 404);
  }
});

Route::middleware('auth:sanctum', 'admin')-> delete ('/tips', [TipsController::class, 'delete']); 
{/*Route::middleware('auth:sanctum', 'admin')-> delete ('/tip/{id}', function($id){
  $tip = Tip::find($id);

  if($id){
    $tip->comments()->delete();
    $tip->delete();
    return response()->json(['message' => 'Tip und dazugehörende Kommentare erfolgreich gelöscht']);
  }else{
    return response()->json(['message'=> 'Tip nicht gefunden'], 404);
  }
});*/}

            // Route::middleware('auth:sanctum')->post ('/tipimage', [TipimageController::class, 'create']);
            // Route::middleware('auth:sanctum')->post ('/tipimage/replace', [TipimageController::class, 'replace']);
            // Route::middleware('auth:sanctum')->delete ('/tipimage', [TipimageController::class, 'delete']);

  // Route::middleware('auth:sanctum')->post ('/comments', [CommentsController::class, 'create']); // löschen
  // Route::middleware('auth:sanctum')->patch ('/comments', [CommentsController::class, 'update']); // löschen
  // Route::middleware('auth:sanctum')->delete ('/comments', [CommentsController::class, 'delete']); // löschen
Route::middleware('auth:sanctum')-> post ('/comments', [CommentsController::class, 'create']); 
Route::middleware('auth:sanctum')-> patch ('/comments', [CommentsController::class, 'update']); 
Route::middleware('auth:sanctum')-> patch ('/comment/{id}', function($id){
  $comment = Comment::find($id);

  if($id) {
    $comment->update([
      'comment_text' => request('comment_text'),
    ]);
    return response()->json(['message' => 'Comment erfolgreich upgedated']);
  } else {
    return response()->json(['message'=> 'Comment nicht gefunden'], 404);
  }
}); 
Route::middleware('auth:sanctum')-> delete ('/comments', [CommentsController::class, 'delete']);
{/*Route::middleware('auth:sanctum')-> delete ('/comment/{id}', [CommentsController::class, 'delete']);*/}
{/*Route::middleware('auth:sanctum')-> delete ('/comment/{id}', function($id){
  $comment = Comment::find($id);

  if($comment){
    $comment->delete();
    return response()->json(['message' => 'Comment erfolgreich gelöscht']);
  }else{
    return response()->json(['message'=> 'Comment nicht gefunden'], 404);
  }
});*/}

// });
