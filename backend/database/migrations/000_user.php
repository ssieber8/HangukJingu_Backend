<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  function up(): void {
    Schema::create(User::table(), function (Blueprint $table) {
      $table->id(); // immer brauchen
      $table->string('username');
      $table->string('email');
      $table->string('password');
      // $table->foreignId('userimage_id')->nullable();
      $table->string('userimage_URL')->nullable();
      $table->boolean('is_admin')->default(false);
      $table->timestamps(); // immer brauchen
    });
  }

  function down(): void {
    Schema::dropIfExists(User::table());
  }
};