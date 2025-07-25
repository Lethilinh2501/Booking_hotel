<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Refund;

class RefundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Refund::factory()->count(5)->create();
    }
}
