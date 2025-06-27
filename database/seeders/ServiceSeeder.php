<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Dọn phòng hàng ngày', 'price' => 0, 'is_active' => true],
            ['name' => 'Đưa đón sân bay', 'price' => 200000, 'is_active' => true],
            ['name' => 'Giặt ủi', 'price' => 50000, 'is_active' => true],
            ['name' => 'Phục vụ bữa sáng', 'price' => 80000, 'is_active' => true],
            ['name' => 'Gọi đồ ăn 24/7', 'price' => 0, 'is_active' => true],
            ['name' => 'Thuê xe đạp', 'price' => 100000, 'is_active' => true],
            ['name' => 'Trang trí sinh nhật tại phòng', 'price' => 300000, 'is_active' => true],
            ['name' => 'Set rượu & trái cây', 'price' => 250000, 'is_active' => true],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
