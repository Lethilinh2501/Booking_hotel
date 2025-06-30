<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StaffRole;

class StaffRoleSeeder extends Seeder
{
    public function run(): void
    {

        // 1. Tạo Admin full quyền
        StaffRole::create([
            'name' => 'Admin',
            'permissions' => json_encode([
                'view' => true,
                'edit' => true,
                'delete' => true,
                'create' => true,
            ]),
        ]);

        // 2. Tạo 4 vai trò ngẫu nhiên còn lại bằng factory
        StaffRole::factory()->count(4)->create();
    }
}
