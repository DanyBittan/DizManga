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
            'user_img' => 'https://mf.b37mrtl.ru/rbthmedia/images/2021.06/original/60c5350115e9f9152b1c4529.jpg',
            'admin' => 1
        ]);

        \App\Models\User::create([
            'name' => 'normal',
            'email' => 'normal@normal.com',
            'password' => bcrypt('holamundo'),
            'user_img' => 'https://mf.b37mrtl.ru/rbthmedia/images/2021.06/original/60c5350115e9f9152b1c4529.jpg',
            'admin' => 0
        ]);
        \App\Models\Comic::factory(30)->create();
        \App\Models\User::factory(30)->create();

        $comics = \App\Models\Comic::all();
        $users = \App\Models\User::all();

        foreach ($comics as $comic) {
            foreach ($users as $user) {
                if (rand(0, 2) == 2) {
                    $user->MyBooks()->attach($comic);
                    \App\Models\Review::factory(1)->create([
                        "user_id" => $user->id,
                        "comic_id" => $comic->id,
                    ]);
                }
                if (rand(0, 3) == 3) {
                    $user->WishList()->attach($comic);
                }
            }
        }
    }
}
