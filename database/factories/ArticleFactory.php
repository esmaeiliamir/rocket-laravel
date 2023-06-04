<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title = fake()->text(30);
        return [


            'user_id' => fake()->numberBetween(1, 30),
            'title' => $title,
            'slug' => str_slug($title),
            'body' => fake()->text(300),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
}
