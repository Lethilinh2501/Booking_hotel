<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? 1,
            'method' => $this->faker->randomElement(['vnpay', 'momo', 'banking', 'cash']),
            'amount' => $this->faker->randomFloat(2, 100000, 1000000),
            'is_partial' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'transaction_id' => $this->faker->unique()->numerify('########'),
            'booking_id' => Booking::inRandomOrder()->value('id') ?? 1,
        ];
    }
}
