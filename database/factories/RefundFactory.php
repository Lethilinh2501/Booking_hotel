<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\RefundPolicy;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefundFactory extends Factory
{
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'refund_policy_id' => RefundPolicy::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 300000),
            'cancellation_fee' => $this->faker->randomFloat(2, 0, 300000),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'reason' => $this->faker->optional()->sentence(),
            'admin_notes' => $this->faker->optional()->paragraph(),
            'approved_by' => $this->faker->optional()->numberBetween(1, 5),
            'approved_at' => $this->faker->optional()->dateTime(),
            'refund_method' => $this->faker->optional()->randomElement(['vnpay', 'momo', 'cash']),
            'transaction_id' => $this->faker->optional()->uuid(),
        ];
    }
}
