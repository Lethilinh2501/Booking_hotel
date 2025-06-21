<?php

namespace Database\Seeders;

use App\Models\RoomType;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        RoomType::factory()->count(6)->create();
    }
}
