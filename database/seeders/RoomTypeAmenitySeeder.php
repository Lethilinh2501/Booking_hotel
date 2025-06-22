<?php

namespace Database\Seeders;

use App\Models\RoomTypeAmenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomTypeAmenity::factory()->count(15)->create();
    }
}
