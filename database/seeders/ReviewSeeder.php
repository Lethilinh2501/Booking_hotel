<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            for ($i = 1; $i <= 10; $i++) {
        DB::table('reviews')->insert([
            'user_id' => rand(1, 5), 
            'booking_id' => $i,    
            'rating' => rand(1, 5),
            'comment' => 'Đánh giá mẫu số ' . $i,
            'response' => rand(0, 1) ? 'Cảm ơn bạn đã đánh giá!' : null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        }
    }
}
