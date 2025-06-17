<?php

namespace Database\Seeders;

use App\Models\BookingPromotion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingPromotionSeeder extends Seeder
{

    public function run(): void
    {
        BookingPromotion::factory()->count(15)->create();
    }
}
