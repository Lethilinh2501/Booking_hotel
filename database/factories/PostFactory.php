<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use App\Models\User;

class PostFactory extends Factory
{
    protected $model = \App\Models\Post::class;

    public function definition()
    {
        // Lấy một category_id ngẫu nhiên (nếu có dữ liệu)
        $categoryId = PostCategory::inRandomOrder()->value('id') ?? 1;

        // Lấy một author_id ngẫu nhiên (nếu có dữ liệu)
        $authorId = User::inRandomOrder()->value('id') ?? 1;

        $title = $this->faker->sentence(6, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->randomNumber(4),
            'excerpt' => $this->faker->text(100),
            'content' => $this->faker->paragraphs(4, true),
            'image' => $this->faker->imageUrl(800, 400, 'nature', true, 'posts'),
            'category_id' => $categoryId,
            'author_id' => $authorId,
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'is_featured' => $this->faker->boolean(20), // 20% là bài nổi bật
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
        ];
    }
}
