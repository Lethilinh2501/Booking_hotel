<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    protected $model = Guest::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'id_number' => $this->faker->numerify('#########'),
            'id_photo' => $this->faker->imageUrl(640, 480, 'people', true),
            'birth_date' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'country' => $this->faker->country,
            'relationship' => $this->faker->randomElement(['friend', 'family', 'partner']),
        ];
    }
}
