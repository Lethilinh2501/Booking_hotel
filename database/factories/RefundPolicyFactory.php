<?php

namespace Database\Factories;

use App\Models\RefundPolicy;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefundPolicyFactory extends Factory
{
    protected $model = RefundPolicy::class;

    public function definition(): array
    {
        return [
            'name' => 'Hủy trước ' . $this->faker->numberBetween(1, 14) . ' ngày',
            'days_before_checkin' => $this->faker->numberBetween(1, 14),
            'refund_percentage' => 100.00,
            'cancellation_fee_percentage' => 0.00,
            'description' => 'Hoàn trả 100% số tiền đã thanh toán',
            'is_active' => true,
        ];
    }
}
