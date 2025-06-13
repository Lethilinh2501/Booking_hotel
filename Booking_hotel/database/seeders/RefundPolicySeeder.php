<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    public function run(): void
    {
        Policy::create([
            'title' => 'Chính sách hoàn tiền',
            'content' => 'Hoàn tiền trong vòng 3 ngày trước ngày đặt.',
            'is_active' => true,
        ]);

        Policy::create([
            'title' => 'Chính sách hủy phòng',
            'content' => 'Hủy phòng trước 48h không tính phí.',
            'is_active' => true,
        ]);
    }
}
