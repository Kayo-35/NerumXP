<?php

namespace Database\Factories\Personas;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personas\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cd_assinatura' => fake()->numberBetween(1, 3),
            'password' => Hash::make('12345678'), //bcrypt(...)
            'email' => fake()->email(),
            'email_verified_at' => fake()->dateTimeBetween('-5 years', 'now'),
            'nm_usuario' => fake()->name(),
            'dt_nascimento' => fake()->date(max: '2007-01-01'),
        ];
    }
}
