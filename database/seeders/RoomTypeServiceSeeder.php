<?php

namespace Database\Seeders;

use App\Models\RoomTypeService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomTypeService::factory()->count(10)->create();
    }
}
