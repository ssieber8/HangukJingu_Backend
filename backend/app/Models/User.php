<?php

namespace App\Models;

use Illuminate\Http\Request;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Sanctum\HasApiTokens;

// use Lab404\Impersonate\Models\Impersonate;

 /**
 * @property string $username
 * @property string $email
 * @property string $password
 * @property boolean $is_admin
 * @property string $userimage_URL
 */

class User extends Model implements AuthenticatableContract {
  use Authenticatable, HasApiTokens; // , Impersonate

  protected $hidden = ['password'];
  protected $fillable = ['username', 'email', 'password', 'is_admin', 'userimage_URL'];

    static function validate (Request $request, $isNew = false) {
      $requiredIfnew = $isNew ? 'required' : 'sometimes';
      return $request->validate([
        'username'=>[$requiredIfnew, 'min:3'],
        'email'=>[$requiredIfnew, 'email'],
        'password'=>[
            $requiredIfnew,
            'min:8',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ],
        'userimage_URL'=>'nullable',
      ]);
    }

    //static function validate (Request $request, $isNew = false) {
    //   $requiredIfnew = $isNew ? 'required' : 'sometimes';
    //   $validator = $request->validate([
    //   'username'=>[$requiredIfnew, 'min:3'],
    //   'email'=>[$requiredIfnew, 'email'],
    //   'password'=>[$requiredIfnew, 'min:8'],
    // ]);
    // if ($validator->fails()) {
    //   return response()->json(['errors' => $validator->errors()], 422);
    // }
    // }


    // zusätzlich!!!!!!! Methode zum bild speichern
    public function saveImage($imageURL) {
      $this->userimage_URL = $imageURL;
      $this->save();
    }


    // Beziehung

    function tips() {
      return $this->hasMany(Tip::class);
    }

    function comments() {
      return $this->hasMany(Comment::class);
    }
  }