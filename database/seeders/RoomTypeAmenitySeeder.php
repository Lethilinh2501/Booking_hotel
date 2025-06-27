<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeAmenitySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Phòng đơn (ID = 1)
            [1, 1], // Điều hòa
            [1, 2], // TV màn hình phẳng
            [1, 9], // Wifi miễn phí

            // Phòng đôi (ID = 2)
            [2, 1],
            [2, 2],
            [2, 4], // Bàn làm việc
            [2, 9],

            // Phòng gia đình (ID = 3)
            [3, 1],
            [3, 2],
            [3, 3], // Bồn tắm
            [3, 5], // Máy sấy tóc
            [3, 9],

            // Phòng VIP (ID = 4) – tất cả tiện nghi
            [4, 1],
            [4, 2],
            [4, 3],
            [4, 4],
            [4, 5],
            [4, 6],
            [4, 7],
            [4, 8],
            [4, 9],
        ];

        foreach ($data as [$roomTypeId, $amenityId]) {
            DB::table('room_type_amenities')->insert([
                'room_type_id' => $roomTypeId,
                'amenity_id' => $amenityId,
            ]);
        }
    }
}
