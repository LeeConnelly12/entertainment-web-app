<?php

namespace Database\Factories;

use App\Enums\ShowCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Show>
 */
class ShowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->text(25),
            'year' => fake()->numberBetween(2000, 2020),
            'rating' => 'PG',
            'is_bookmarked' => fake()->boolean(),
            'is_trending' => fake()->boolean(),
            'category' => ShowCategory::cases()[fake()->numberBetween(0,1)],
        ];
    }

    /**
     * Indicate that the show is a movie.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function movie()
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => ShowCategory::MOVIE,
            ];
        });
    }

    /**
     * Indicate that the show is a TV series.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function tvseries()
    {
        return $this->state(function (array $attributes) {
            return [
                'category' => ShowCategory::TVSERIES,
            ];
        });
    }
}
