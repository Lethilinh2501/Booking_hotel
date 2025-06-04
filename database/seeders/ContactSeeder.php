<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
 {
        for ($i = 1; $i <= 20; $i++) {
            Contact::create([
                'title' => 'Liên hệ ' . $i,
                'phone' => '09' . rand(10000000, 99999999),
                'email' => 'user' . $i . '@example.com',
                'content' => Str::random(100),
                'status' => collect(['pending', 'approved', 'rejected'])->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
