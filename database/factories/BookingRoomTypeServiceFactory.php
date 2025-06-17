<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\BookingRoomTypeService;
use App\Models\RoomTypeService;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingRoomTypeServiceFactory extends Factory
{
    protected $model = BookingRoomTypeService::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::inRandomOrder()->value('id'), // Giả sử có sẵn dữ liệu
            'room_type_service_id' => RoomTypeService::inRandomOrder()->value('id'),
            'quantity' => $this->faker->numberBetween(1, 3),
            'price' => $this->faker->randomFloat(2, 100000, 500000),
        ];
    }
}
