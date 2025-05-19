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
    protected static ?string $password;
    
    public function definition(): array
    {
        $role = fake()->randomElement(['admin', 'operator', 'user']);

        // Sesuaikan nama dan username berdasarkan role
        $name = match($role) {
            'admin' => 'Administrator',
            'operator' => 'Petugas Operator',
            'user' => fake()->name(),
        };

        $username = match($role) {
            'admin' => 'admin',
            'operator' => 'operator',
            'user' => fake()->userName(),
        };

        return [
            'name' => $name,
            'username' => $username,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'number_phone' => fake()->numerify('08##########'),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => $role,
        ];
    }
}

