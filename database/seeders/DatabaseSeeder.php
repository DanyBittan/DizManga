<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'danybi',
            'email' => 'danybi@admin.com',
            'password' => bcrypt('holamundo'),
            'admin' => 1
        ]);

        \App\Models\User::create([
            'name' => 'normal',
            'email' => 'normal@normal.com',
            'password' => bcrypt('holamundo'),
            'admin' => 0
        ]);
        \App\Models\Comic::factory(30)->create();
        \App\Models\User::factory(30)->create();

        $comics = \App\Models\Comic::all();
        $users = \App\Models\User::all();

        foreach ($comics as $comic) {
            foreach ($users as $user) {
                if (rand(0, 2) == 2) {
                    $comic->MyBooks()->attach($user);
                    \App\Models\Review::factory(1)->create([
                        "user_id" => $user->id,
                        "comic_id" => $comic->id,
                    ]);
                }
            }
        }
    }
}
