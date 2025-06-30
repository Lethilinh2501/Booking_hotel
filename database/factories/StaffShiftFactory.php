<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StaffShiftFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Ca sáng', 'Ca chiều', 'Ca tối']),
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
        ];
    }
}
