<?php

namespace Database\Seeders;

use App\Models\Booking;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Booking::create([
                'booking_code' => 'BK-' . strtoupper(Str::random(6)),
                'check_in' => now()->addDays(rand(1, 5)),
                'check_out' => now()->addDays(rand(6, 10)),
                'actual_check_in' => null,
                'actual_check_out' => null,
                'total_price' => 5000000,
                'paid_amount' => 2500000,
                'discount_amount' => 500000,
                'base_price' => 4500000,
                'service_total' => 300000,
                'tax_fee' => 200000,
                'total_guests' => 2,
                'children_count' => 0,
                'room_quantity' => 1,
                'user_id' => 1, // nhớ tạo user id=1 hoặc chỉnh lại cho đúng
                'special_request' => 'View biển, thêm 2 gối ôm',
                'service_plus_status' => 'not_yet_paid',
                'status' => 'partial',
                'service_plus_total' => 300000,
            ]);
        }

        Booking::factory()->count(15)->create();

    }
}
