<?php

namespace Database\Factories;

use App\Models\RoomType;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room_type_id' => RoomType::inRandomOrder()->first()?->id ?? RoomType::factory(),
            'service_id' => Service::inRandomOrder()->first()?->id ?? Service::factory(),
            'price' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
