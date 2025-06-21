<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Service',
            'price' => $this->faker->randomFloat(2, 10, 500),
            'is_active' => $this->faker->boolean(80), // 80% là true
        ];
    }
}
