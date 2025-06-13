<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'slug' => Str::slug($title . '-' . $this->faker->unique()->randomNumber()),
            'excerpt' => $this->faker->paragraph,
            'content' => $this->faker->paragraphs(3, true),
            'image' => 'uploads/posts/default.jpg',
            'category_id' => PostCategory::factory(),
            'author_id' => User::factory(),
            'published_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
            'is_featured' => $this->faker->boolean(20),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
        ];
    }
}
