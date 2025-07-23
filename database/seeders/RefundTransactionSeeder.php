<?php

namespace Database\Seeders;

use App\Models\RefundTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefundTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RefundTransaction::factory()->count(5)->create();
    }
}
