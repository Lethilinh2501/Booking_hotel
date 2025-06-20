<?php

namespace Database\Seeders;

use App\Models\BookingRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookingRoom::factory()->count(15)->create();
    }
}
