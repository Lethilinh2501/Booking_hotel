<?php

namespace Database\Seeders;

use App\Models\ServicePlus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicePlusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServicePlus::factory()->count(10)->create();
    }
}
