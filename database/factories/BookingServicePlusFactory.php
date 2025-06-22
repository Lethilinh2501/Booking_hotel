<?php

namespace Database\Factories;

use App\Models\BookingServicePlus;
use App\Models\Booking;
use App\Models\ServicePlus;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingServicePlusFactory extends Factory
{
    protected $model = BookingServicePlus::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::inRandomOrder()->value('id'),
            'service_plus_id' => ServicePlus::inRandomOrder()->value('id'),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
