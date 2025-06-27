<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServicePlus;

class ServicePlusSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Tính phí đổ vỡ', 'price' => 0, 'is_active' => true],
            ['name' => 'Dịch vụ dọn vệ sinh đặc biệt', 'price' => 200000, 'is_active' => true],
            ['name' => 'Ghi nhận dùng minibar', 'price' => 0, 'is_active' => true],
            ['name' => 'Phí phát sinh giờ trả phòng', 'price' => 150000, 'is_active' => true],
        ];

        foreach ($data as $item) {
            ServicePlus::create($item);
        }
    }
}
