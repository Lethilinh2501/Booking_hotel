<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $checkIn = $this->faker->dateTimeBetween('+0 days', '+7 days');
        $checkOut = (clone $checkIn)->modify('+1 day');

        return [
            'booking_code' => 'BOOK' . $this->faker->unique()->numerify('##########'),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'actual_check_in' => null,
            'actual_check_out' => null,
            'total_price' => 500000,
            'paid_amount' => $this->faker->randomElement([0, 200000, 500000]),
            'discount_amount' => $this->faker->randomElement([0, 50000, 100000]),
            'base_price' => 400000,
            'service_total' => $this->faker->randomElement([0, 50000, 100000]),
            'tax_fee' => 50000,
            'total_guests' => $this->faker->numberBetween(1, 5),
            'children_count' => $this->faker->numberBetween(0, 3),
            'room_quantity' => $this->faker->numberBetween(1, 3),
            'user_id' => $this->faker->numberBetween(1, 5), // khớp số lượng UserSeeder
            'special_request' => $this->faker->optional()->sentence(),
            'service_plus_status' => $this->faker->randomElement(['not_yet_paid', 'paid', 'partial', 'none']),
            'status' => $this->faker->randomElement([
                'unpaid',
                'partial',
                'paid',
                'check_in',
                'check_out',
                'cancelled',
                'cancelled_without_refund',
                'refunded'
            ]),
            'service_plus_total' => $this->faker->randomElement([0, 100000, 500000]),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Booking $booking) {
            $booking->payments()->create([
                'user_id' => $booking->user_id,
                'amount' => $booking->paid_amount,
                'status' => 'pending',
                'transaction_id' => 'TRANS' . Str::random(10),
                'is_partial' => $booking->paid_amount < $booking->total_price,
                'method' => 'vnpay',
            ]);
        });
    }
}
