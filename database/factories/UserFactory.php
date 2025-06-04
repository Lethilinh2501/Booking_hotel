<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $name = $this->faker->name($gender);

        return [
            'name' => $name,
            'phone' => $this->faker->phoneNumber(),
            'avatar' => $this->faker->imageUrl(200, 200, 'people'),
            'address' => $this->faker->address(),
            'id_number' => $this->faker->numerify('#########'),
            'id_photo' => $this->faker->imageUrl(640, 480, 'id-card'),
            'birth_date' => $this->faker->date('Y-m-d', '-18 years'),
            'country' => $this->faker->country(),
            'gender' => $gender,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // hoặc Hash::make()
            'is_active' => true,
            'remember_token' => Str::random(10),
            'role' => $this->faker->randomElement(['admin', 'staff', 'user']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Define admin state.
     */
    public function admin(): static
    {
        return $this->state(fn() => [
            'role' => 'admin',
        ]);
    }

    /**
     * Define staff state.
     */
    public function staff(): static
    {
        return $this->state(fn() => [
            'role' => 'staff',
        ]);
    }

    /**
     * Define user state.
     */
    public function user(): static
    {
        return $this->state(fn() => [
            'role' => 'user',
        ]);
    }
}
