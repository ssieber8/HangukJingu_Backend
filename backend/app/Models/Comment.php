<?php

namespace App\Models;

use Illuminate\Http\Request;

// // use Illuminate\Database\Eloquent\Model;

 /**
 * @property string $comment_text
 * @property numeric $tip_id // hinzugefügt
 * @property numeric $user_id
 */

class Comment extends Model {
    
  static function validate (Request $request, $isNew = false) {
      $requiredIfnew = $isNew ? 'required' : 'sometimes';
      return $request->validate([
      'comment_text'=>[$requiredIfnew], // von fill im Controller
      'tip_id'=>[$requiredIfnew],
      // 'user_id'=>[$requiredIfnew], // hinzugefügt!
    ]);
    }

     function tips() {
       return $this->belongsTo(Tip::class);
     }

    function user() {
      return $this->belongsTo(User::class);
    }
  }