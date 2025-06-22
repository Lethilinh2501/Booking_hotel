<?php

namespace Database\Factories;

use App\Models\RulesAndRegulation;
use Illuminate\Database\Eloquent\Factories\Factory;

class RulesAndRegulationFactory extends Factory
{
    protected $model = RulesAndRegulation::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(5),
            'is_active' => $this->faker->boolean(90), // 90% là true
        ];
    }
}
