<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'guard_name' => 'web'],
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'Lễ tân', 'guard_name' => 'web'],
            ['name' => 'Customer', 'guard_name' => 'web'],
        ];

        foreach ($roles as $roleData) {
            Role::firstOrCreate($roleData);
        }
    }
}
