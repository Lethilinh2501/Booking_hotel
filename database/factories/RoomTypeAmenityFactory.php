<?php

namespace Database\Factories;

use App\Models\RoomType;
use App\Models\Amenity;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeAmenityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room_type_id' => RoomType::inRandomOrder()->first()?->id ?? RoomType::factory(),
            'amenity_id' => Amenity::inRandomOrder()->first()?->id ?? Amenity::factory(),
        ];
    }
}
