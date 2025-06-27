<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->bothify('###'),
            'room_type_id' => RoomType::inRandomOrder()->first()?->id ?? RoomType::factory(),
            'floor' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement([
                'available',
                'booked',
                'maintenance',
            ]),


        ];
    }
}
