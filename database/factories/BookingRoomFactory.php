<?php

namespace Database\Factories;

use App\Models\BookingRoom;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingRoomFactory extends Factory
{
    protected $model = BookingRoom::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::inRandomOrder()->value('id'), // cần có dữ liệu trước
            'room_id' => Room::inRandomOrder()->value('id'),       // cần có dữ liệu trước
        ];
    }
}
