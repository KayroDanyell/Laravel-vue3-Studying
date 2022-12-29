<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Despesa>
 */
class DespesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'desc' => fake()->words( 3,  true),
            'data' => fake()->dateTime(),
            'user' => fake()->numberBetween(1,11), // password
            'valor' => fake()->numberBetween(1,11),
        ];
    }
}
