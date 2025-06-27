<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\RoomTypeService;

class RoomTypeServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::pluck('id', 'name')->toArray();
        $roomTypes = RoomType::pluck('id', 'name')->toArray();

        $mapping = [
            'Phòng đơn' => [
                ['name' => 'Dọn phòng hàng ngày', 'price' => 0],
                ['name' => 'Phục vụ bữa sáng', 'price' => 80000],
                ['name' => 'Giặt ủi', 'price' => 50000],
            ],
            'Phòng đôi' => [
                ['name' => 'Dọn phòng hàng ngày', 'price' => 0],
                ['name' => 'Phục vụ bữa sáng', 'price' => 80000],
                ['name' => 'Giặt ủi', 'price' => 50000],
            ],
            'Phòng gia đình' => [
                ['name' => 'Dọn phòng hàng ngày', 'price' => 0],
                ['name' => 'Phục vụ bữa sáng', 'price' => 80000],
                ['name' => 'Giặt ủi', 'price' => 50000],
                ['name' => 'Thuê xe đạp', 'price' => 100000],
            ],
            'Phòng VIP' => [
                ['name' => 'Dọn phòng hàng ngày', 'price' => 0],
                ['name' => 'Đưa đón sân bay', 'price' => 200000],
                ['name' => 'Giặt ủi', 'price' => 50000],
                ['name' => 'Phục vụ bữa sáng', 'price' => 80000],
                ['name' => 'Gọi đồ ăn 24/7', 'price' => 0],
                ['name' => 'Thuê xe đạp', 'price' => 100000],
                ['name' => 'Trang trí sinh nhật tại phòng', 'price' => 300000],
                ['name' => 'Set rượu & trái cây', 'price' => 250000],
            ],
        ];

        foreach ($mapping as $roomName => $serviceItems) {
            $roomTypeId = $roomTypes[$roomName] ?? null;

            if ($roomTypeId) {
                foreach ($serviceItems as $item) {
                    $serviceId = $services[$item['name']] ?? null;

                    if ($serviceId) {
                        RoomTypeService::create([
                            'room_type_id' => $roomTypeId,
                            'service_id' => $serviceId,
                            'price' => $item['price'],
                        ]);
                    }
                }
            }
        }
    }
}
