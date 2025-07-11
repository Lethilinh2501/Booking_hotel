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
        // Tạo 5 bản ghi Refund giả lập
        for ($i = 1; $i <= 5; $i++) {
            Refund::create([
                'payment_id' => $i,
                'amount'     => rand(100000, 500000),
                'status'     => collect(['pending', 'approved', 'rejected'])->random(),
            ]);
        }
    }
}
