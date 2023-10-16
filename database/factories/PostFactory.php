<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'slug' => Str::random(4),
            'category_id' => fake()->randomDigit(1),
            'title' => fake()->title,
            'description' => fake()->text,
            'picture' => fake()->image(),
            'status' => 'published'
        ];
    }
}
