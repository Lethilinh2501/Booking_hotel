<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        Promotion::create([
            'title' => 'Giảm 20% toàn bộ dịch vụ',
            'description' => 'Áp dụng toàn bộ dịch vụ tại khách sạn',
            'discount_percent' => 20,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
        ]);
    }
}
