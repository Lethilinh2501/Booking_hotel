<?php

namespace Database\Factories;

use App\Models\Refund;
use App\Models\RefundTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefundTransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'refund_id' => Refund::factory(),
            'transaction_type' => $this->faker->randomElement(['refund', 'refund_request', 'refund_reject']),
            'amount' => $this->faker->randomFloat(2, 100000, 300000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'payment_method' => $this->faker->optional()->randomElement(['vnpay', 'momo', 'none']),
            'transaction_id' => $this->faker->optional()->uuid(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
