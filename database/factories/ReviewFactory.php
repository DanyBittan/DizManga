<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->text(),
            'likes' => $this->faker->randomNumber(6, false),
            'dislikes' => $this->faker->randomNumber(6, false),
            'rating' => $this->faker->randomFloat(1, 1, 5)
        ];
    }
}
