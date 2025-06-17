<?php

namespace Database\Factories;

use App\Models\BookingGuest;
use App\Models\Booking;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingGuestFactory extends Factory
{
    protected $model = BookingGuest::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::inRandomOrder()->first()?->id ?? Booking::factory(),
            'guest_id' => Guest::inRandomOrder()->first()?->id ?? Guest::factory(),
        ];
    }
}
