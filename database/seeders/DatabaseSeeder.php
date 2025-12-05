<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
            'password' => Hash::make('holamundo'),
            'user_img' => 'https://mf.b37mrtl.ru/rbthmedia/images/2021.06/original/60c5350115e9f9152b1c4529.jpg',
            'admin' => 1
        ]);

        \App\Models\User::create([
            'name' => 'normal',
            'email' => 'normal@normal.com',
            'password' => Hash::make('holamundo'),
            'user_img' => 'https://mf.b37mrtl.ru/rbthmedia/images/2021.06/original/60c5350115e9f9152b1c4529.jpg',
            'admin' => 0
        ]);

        $publisher = ["Shueisha", "Kodansha", "Shogakukan", "VIZ Media", "Dark Horse Comics"];
        $letter = collect(range('a', 'z'))->random();
        $data = Http::get('https://comicvine.gamespot.com/api/issues/', [
            'api_key' => env('COMICSVINE_API_KEY'),
            'format'  => 'json',
            'limit'   => 50,
            'filter'  => 'name:' . $letter,
        ])->json();
        $results = $data['results'] ?? [];
        foreach ($results as $result) {
            \App\Models\Comic::create([
                'title'       => $result['name'] ?? 'Sin título',
                'img'         => $result['image']['original_url'] ?? null,
                'publisher'   => $publisher[array_rand($publisher)],
                'ISBN'        => rand(100000000, 999999999),
                'launch_date' => $result['cover_date'] ?? now(),
                'price'       => rand(4, 25) . '.' . rand(0, 99),
                'sinopsis'    => $result['description'] ?? 'No description available.',
                'slug'        => Str::slug(($result['name'] ?? 'comic') . '-' . rand(1000, 9999)),
            ]);
        }

        //        \App\Models\Comic::factory(30)->create();
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
