<?php

use App\Models\Comment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  // public function up() { // löschen!!!!!!!!!!!!!!!!!!!!!!!!!!!
  function up() {
    Schema::create(Comment::table(), function (Blueprint $table) {
      $table->id(); // immer brauchen
      $table->text('comment_text');
      $table->foreignId('tip_id');
      // $table->foreignId('user_id')->nullable(); // löschen!!!!!!!!!!!!!!!!!!!!!!!!!!
      $table->foreignId('user_id');
      $table->timestamps(); // immer brauchen
    });
  }

  function down() {
    Schema::dropIfExists(Comment::table());
  }
};