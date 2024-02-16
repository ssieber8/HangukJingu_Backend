<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// faker: https://fakerphp.github.io/formatters/text-and-paragraphs/

class DatabaseSeeder extends Seeder {
  function run() {
    User::create([
      'username' => 'Admin',
      'email' => 'admin@admin.com',
      'password' => Hash::make('Admin_Password!'),
      'is_admin' => true,
    ]);

    {/*$userB = User::create([
      'username' => 'siebers',
      'email' => 'siebers@siebers.ch',
      'password' => Hash::make('password'),
    ]);*/}

    {/*for ($i = 0; $i < 5; $i++) {
      $userA->tips()->create([
        'tip_name' => fake()->word(),
        'tip_text' => fake()->sentences(4, true),
      ]);

      $userB->tips()->create([
        'tip_name' => fake()->word(),
        'tip_text' => fake()->sentences(4, true),
      ]);

    $userA->comments()->create([
    'comment_text' => fake()->sentences(4, true),
    ]);

    $userB->comment()->create([
    'comment_text' => fake()->sentences(4, true),
    ]);
    }*/}
  }
}


