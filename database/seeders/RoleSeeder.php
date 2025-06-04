<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa hết data cũ (nếu muốn)
        Role::query()->delete();

        // Tạo 3 vai trò cố định
        Role::insert([
            ['name' => 'Admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nhân viên', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Quản lý', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
