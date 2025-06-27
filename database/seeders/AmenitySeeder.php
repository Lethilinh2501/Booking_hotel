<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            ['name' => 'Điều hòa', 'is_active' => true],
            ['name' => 'TV màn hình phẳng', 'is_active' => true],
            ['name' => 'Bồn tắm', 'is_active' => true],
            ['name' => 'Bàn làm việc', 'is_active' => true],
            ['name' => 'Máy sấy tóc', 'is_active' => true],
            ['name' => 'Tủ lạnh mini', 'is_active' => true],
            ['name' => 'Két sắt', 'is_active' => true],
            ['name' => 'Ban công riêng', 'is_active' => true],
            ['name' => 'Wifi miễn phí', 'is_active' => true],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}
