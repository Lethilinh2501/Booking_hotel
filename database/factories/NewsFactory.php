<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'excerpt' => $this->faker->paragraph,
            'content' => $this->faker->text(2000),
            'image' => $this->faker->imageUrl(800, 400),
            'category_id' => \App\Models\NewsCategory::factory(),
            'author_id' => \App\Models\User::factory(),
            'published_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'is_featured' => $this->faker->boolean(20),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
        ];
    }
}