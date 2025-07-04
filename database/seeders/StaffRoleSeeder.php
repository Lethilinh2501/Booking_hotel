<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffRoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('staff_roles')->insert([
            [
                'name' => 'Quản trị hệ thống',
                'permissions' => json_encode(['manage_users', 'manage_rooms', 'view_reports']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lễ tân',
                'permissions' => json_encode(['check_in', 'check_out', 'manage_bookings']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kế toán',
                'permissions' => json_encode(['view_reports', 'manage_payments']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
