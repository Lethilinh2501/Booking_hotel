<?php

namespace Database\Seeders;

use App\Models\RefundPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefundPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RefundPolicy::factory()->count(5)->create();
    }
}
