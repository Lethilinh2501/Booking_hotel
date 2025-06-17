<?php

namespace Database\Seeders;

use App\Models\BookingGuest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingGuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookingGuest::factory()->count(15)->create();
    }
}
