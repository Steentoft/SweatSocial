<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'username' => 'TestUser',
             'email' => 'test@example.com',
             'first_name' => 'test',
             'password' => Hash::make('password'),
             'last_name' => 'user',
             'birthdate' => '2023-04-04'
         ]);

        \App\Models\User::factory()->create([
            'username' => 'nikolailarsen01',
            'email' => 'ceo@nlsoftware.dk',
            'first_name' => 'Nikolai',
            'last_name' => 'Larsen',
            'password' => Hash::make('password'),
            'birthdate' => '2001-11-06'
        ]);

         $tags = [ 'Wellness', 'Vegetarian', 'Intense_workout', 'Flexibility', 'Cutting', 'Bulking' ];
         foreach ($tags as $tag){
             Tag::create([ 'tag_name' => $tag ]);
         }


    }
}
