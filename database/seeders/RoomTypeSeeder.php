<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Phòng đơn',
                'description' => 'Phòng đơn dành cho 1 người với giường đơn.',
                'price' => 500000,
                'max_capacity' => 1,
                'size' => 15,
                'bed_type' => 'single',
                'children_free_limit' => 0,
                'is_active' => true,
            ],
            [
                'name' => 'Phòng đôi',
                'description' => 'Phòng dành cho 2 người với giường đôi.',
                'price' => 800000,
                'max_capacity' => 2,
                'size' => 22,
                'bed_type' => 'double',
                'children_free_limit' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Phòng gia đình',
                'description' => 'Phòng rộng rãi cho gia đình nhỏ.',
                'price' => 1200000,
                'max_capacity' => 4,
                'size' => 35,
                'bed_type' => 'queen',
                'children_free_limit' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Phòng VIP',
                'description' => 'Phòng sang trọng với dịch vụ cao cấp.',
                'price' => 2500000,
                'max_capacity' => 2,
                'size' => 40,
                'bed_type' => 'king',
                'children_free_limit' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($rooms as $room) {
            RoomType::create($room);
        }
    }
}
