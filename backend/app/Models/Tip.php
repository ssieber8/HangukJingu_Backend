<?php

namespace App\Models;

use Illuminate\Http\Request;

// // use Illuminate\Database\Eloquent\Model;

 /**
 * @property string $tip_name
 * @property string $tip_text
 * @property numeric $user_id
 * @property string $tipimage_URL
 */

class Tip extends Model {
    
  static function validate (Request $request, $isNew = false) {
      $requiredIfnew = $isNew ? 'required' : 'sometimes';
      return $request->validate([
      'tip_name'=>[$requiredIfnew], // von fill im Controller
      'tip_text'=>[$requiredIfnew],
      // 'user_id'=>[$requiredIfnew], // hinzugefügt!
      // 'tipimage_URL'=>['required', 'url'], // angepasst
      'tipimage_URL'=>[$requiredIfnew],
      // 'tipimage_id'=>[$requiredIfnew], // alt....
    ]);
    }

    // zusätzlich!!!!!!! Methode zum bild speichern
    public function saveImage($imageURL) {
      $this->tipimage_URL = $imageURL;
      $this->save();
    }


    function comments() {
       return $this->hasMany(Comment::class);
    }

    function user() {
      return $this->belongsTo(User::class);
    }

    // function tipimage() {
    //   return $this->hasOne(Tipimage::class);
    // }
  }