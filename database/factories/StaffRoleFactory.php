<?php

namespace Database\Factories;

use App\Models\StaffRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StaffRole>
 */
class StaffRoleFactory extends Factory
{
    protected $model = StaffRole::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Quản lý',
                'Nhân viên',
                'Lễ tân',
                'Bảo vệ'
            ]),
            'permissions' => json_encode([
                'view' => $this->faker->boolean(80),    // 80% true
                'edit' => $this->faker->boolean(50),    // 50% true
                'delete' => $this->faker->boolean(30),  // 30% true
                'create' => $this->faker->boolean(60),  // 60% true
            ]),
        ];
    }
}
