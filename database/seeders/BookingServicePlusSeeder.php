<?php

namespace Database\Seeders;

use App\Models\BookingServicePlus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingServicePlusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookingServicePlus::factory()->count(15)->create();
    }
}
