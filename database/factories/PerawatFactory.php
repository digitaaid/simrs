<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perawat>
 */
class PerawatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' => uniqid(),
            'nama' => fake()->name() . ', Ners.',
            'status' => 1,
            'user' => 1,
            'pic' => 'Admin Factory',
        ];
    }
}
