<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StaffShift;

class StaffShiftSeeder extends Seeder
{
    public function run(): void
    {

        StaffShift::insert([
            [
                'name' => 'Ca sáng',
                'start_time' => '06:00:00',
                'end_time' => '14:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ca chiều',
                'start_time' => '14:00:00',
                'end_time' => '22:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ca tối',
                'start_time' => '22:00:00',
                'end_time' => '06:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
