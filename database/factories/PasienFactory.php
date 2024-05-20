<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'norm' => uniqid(),
            'nama' => fake()->name(),
            'gender' => fake()->randomElement(['P', 'L']),
            'tempat_lahir' => fake()->city(),
            'tgl_lahir' => fake()->date(),
            'alamat' => fake()->address(),
            'user' => 1,
            'pic' => 'Admin Factory',
        ];
    }
}
