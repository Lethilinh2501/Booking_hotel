<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StaffShiftFactory extends Factory
{
    public function definition(): array
    {
        // Các ca làm việc mẫu
        $shifts = [
            ['name' => 'Ca sáng',     'start' => '06:00:00', 'end' => '14:00:00'],
            ['name' => 'Ca chiều',    'start' => '14:00:00', 'end' => '22:00:00'],
            ['name' => 'Ca đêm',      'start' => '22:00:00', 'end' => '06:00:00'],
        ];

        $shift = $this->faker->randomElement($shifts);

        return [
            'name' => $shift['name'],
            'start_time' => $shift['start'],
            'end_time' => $shift['end'],
        ];
    }
}
