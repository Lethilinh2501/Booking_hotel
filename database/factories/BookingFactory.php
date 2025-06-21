<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $checkIn = $this->faker->dateTimeBetween('+1 days', '+5 days');
        $checkOut = (clone $checkIn)->modify('+2 days');

        return [
            'booking_code' => strtoupper('BK' . $this->faker->unique()->numerify('#####')),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'actual_check_in' => null,
            'actual_check_out' => null,
            'total_price' => $this->faker->randomFloat(2, 1000000, 5000000),
            'discount_amount' => $this->faker->randomFloat(2, 50000, 200000),
            'base_price' => $this->faker->randomFloat(2, 900000, 4800000),
            'service_total' => $this->faker->randomFloat(2, 50000, 300000),
            'tax_fee' => $this->faker->randomFloat(2, 10000, 50000),
            'total_guests' => $this->faker->numberBetween(1, 6),
            'children_count' => $this->faker->numberBetween(0, 3),
            'room_quantity' => $this->faker->numberBetween(1, 3),
            'status' => $this->faker->randomElement(['confirmed', 'paid', 'check_in', 'check_out', 'cancelled', 'refunded']),
            'user_id' => User::inRandomOrder()->value('id'),
            'special_request' => $this->faker->optional()->sentence,
        ];
    }
}
