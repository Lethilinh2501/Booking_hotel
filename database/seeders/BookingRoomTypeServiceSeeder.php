<?php

namespace Database\Seeders;

use App\Models\BookingRoom;
use App\Models\BookingRoomTypeService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingRoomTypeServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookingRoomTypeService::factory()->count(15)->create();
        
    }
}
