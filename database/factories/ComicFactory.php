<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ComicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'img' => $this->faker->imageUrl(),
            'publisher' => $this->faker->words(2, true),
            'ISBN' => $this->faker->randomNumber(9, true),
            'launch_date' => $this->faker->date('Y_m_d'),
            'type' => $this->faker->word(),
            'genres' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 1, 20),
            'sinopsis' => $this->faker->text(),
            'slug' => $this->faker->slug()
        ];
    }
}
