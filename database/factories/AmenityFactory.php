<?php

namespace Database\Factories;

use App\Models\Amenity;
use Illuminate\Database\Eloquent\Factories\Factory;

class AmenityFactory extends Factory
{
    protected $model = Amenity::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true), // Ví dụ: "Free Wifi"
            'is_active' => $this->faker->boolean(80), // 80% là true
        ];
    }
}
