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
            'refund_id' => $this->faker->numberBetween(1, 100), // Giả định đã có bảng `refunds`
            'transaction_type' => $this->faker->randomElement(['refund_request', 'refund', 'refund_reject']),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'payment_method' => $this->faker->randomElement(['bank_transfer', 'credit_card', 'paypal', null]),
            'transaction_id' => $this->faker->uuid,
            'notes' => $this->faker->optional()->sentence,
        ];
    }
}
