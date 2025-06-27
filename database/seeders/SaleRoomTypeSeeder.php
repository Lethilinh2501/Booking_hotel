<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SaleRoomType;
use App\Models\RoomType;
use Carbon\Carbon;

class SaleRoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $sales = [
            [
                'room' => 'Phòng đơn',
                'name' => 'Giảm 10% mùa hè',
                'value' => 10,
                'type' => 'percent',
            ],
            [
                'room' => 'Phòng đôi',
                'name' => 'Ưu đãi 100k',
                'value' => 100000,
                'type' => 'fixed',
            ],
            [
                'room' => 'Phòng gia đình',
                'name' => 'Family Week giảm 15%',
                'value' => 15,
                'type' => 'percent',
            ],
            [
                'room' => 'Phòng VIP',
                'name' => 'Ưu đãi VIP 500k',
                'value' => 500000,
                'type' => 'fixed',
            ],
        ];

        foreach ($sales as $sale) {
            $room = RoomType::where('name', $sale['room'])->first();
            if ($room) {
                SaleRoomType::create([
                    'name' => $sale['name'],
                    'value' => $sale['value'],
                    'type' => $sale['type'],
                    'room_type_id' => $room->id,
                    'start_date' => $now->copy()->subDays(1),
                    'end_date' => $now->copy()->addDays(30),
                    'status' => 'active',
                ]);
            }
        }
    }
}
