<?php

namespace Database\Factories;

use App\Models\BookingPromotion;
use App\Models\Booking;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingPromotionFactory extends Factory
{
    protected $model = BookingPromotion::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::inRandomOrder()->value('id'),
            'promotion_id' => Promotion::inRandomOrder()->value('id'),
        ];
    }
}
