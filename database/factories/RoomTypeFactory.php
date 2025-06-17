<?php

namespace Database\Factories;

use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeFactory extends Factory
{
    protected $model = RoomType::class;

    public function definition(): array
    {
        return [
            'name' => 'Phòng ' . $this->faker->randomElement(['Đơn', 'Đôi', 'Gia đình', 'VIP']),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 500000, 3000000),
            'max_capacity' => $this->faker->numberBetween(1, 6),
            'size' => $this->faker->randomFloat(1, 15, 50), // mét vuông
            'bed_type' => $this->faker->randomElement(['single', 'double', 'queen', 'king', 'bunk', 'sofa']),
            'children_free_limit' => $this->faker->numberBetween(0, 2),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
