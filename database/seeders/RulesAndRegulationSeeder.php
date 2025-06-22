<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RulesAndRegulation;

class RulesAndRegulationSeeder extends Seeder
{
    public function run(): void
    {
        // $rules = [
        //     ['name' => 'Không hút thuốc trong phòng', 'is_active' => true],
        //     ['name' => 'Không gây ồn sau 22h', 'is_active' => true],
        //     ['name' => 'Mang vật nuôi phải thông báo trước', 'is_active' => false],
        //     ['name' => 'Không tự ý thay đổi vị trí nội thất', 'is_active' => true],
        // ];

        // foreach ($rules as $rule) {
        //     RulesAndRegulation::create($rule);
        // }

        RulesAndRegulation::factory()->count(6)->create();

    }
}
