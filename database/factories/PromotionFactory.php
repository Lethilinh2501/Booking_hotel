<?php

namespace Database\Factories;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PromotionFactory extends Factory
{
    protected $model = Promotion::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $endDate = (clone $startDate)->modify('+' . rand(3, 10) . ' days');

        return [
            'name' => $this->faker->words(3, true),
            'code' => strtoupper(Str::random(8)),
            'value' => $this->faker->randomFloat(2, 5, 100), // giảm giá từ 5 đến 100
            'start_date' => $startDate,
            'end_date' => $endDate,
            'min_booking_amount' => $this->faker->numberBetween(100000, 500000),
            'max_discount_value' => $this->faker->numberBetween(50000, 200000),
            'quantity' => $this->faker->numberBetween(10, 100),
            'type' => $this->faker->randomElement(['percent', 'fixed']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
