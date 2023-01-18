<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory()->create([
             'first_name' => 'Danny',
             'last_name' => 'Festor',
             'user_name' => 'dannyfestor',
             'email' => 'danny@festor.info',
         ]);
         \App\Models\User::factory(10)->create();

         $users = User::all();
         $this->callWith([
             ProjectSeeder::class
         ], ['users' => $users]);

    }
}
