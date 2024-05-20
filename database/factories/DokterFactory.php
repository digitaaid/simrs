<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dokter>
 */
class DokterFactory extends Factory
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
            'nama' => 'Dr. ' . fake()->name(),
            'status' => 1,
            'user' => 1,
            'pic' => 'Admin Factory',
        ];
    }
}
