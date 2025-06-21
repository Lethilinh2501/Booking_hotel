<?php

namespace Database\Seeders;

use App\Models\RoomType;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {

        RoomType::create([
            'name' => 'Phòng Deluxe',
            'description' => 'Phòng rộng rãi, view biển, đầy đủ tiện nghi hiện đại.',
            'price' => 1500000,
            'capacity' => 2
        ]);

        RoomType::create([
            'name' => 'Phòng Superior',
            'description' => 'Phòng tiêu chuẩn với thiết kế trang nhã, thích hợp cho cặp đôi.',
            'price' => 1000000,
            'capacity' => 2
        ]);

        RoomType::create([
            'name' => 'Phòng Family',
            'description' => 'Phòng lớn dành cho gia đình, có không gian riêng cho trẻ em.',
            'price' => 2000000,
            'capacity' => 4
        ]);

        RoomType::factory()->count(6)->create();

    }
}
