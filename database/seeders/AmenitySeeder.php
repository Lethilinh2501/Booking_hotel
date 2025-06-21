<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        Amenity::create([
            'name' => 'Wifi miễn phí',
            'is_active' => true,
        ]);

        Amenity::create([
            'name' => 'Hồ bơi ngoài trời',
            'is_active' => true,
        ]);

        Amenity::factory()->count(10)->create();
    }
}
