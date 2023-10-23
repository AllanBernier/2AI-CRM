<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->languageCode,
            'description' => fake()->text,
            'url' => fake()->url,
            'tjm' => 400 + fake()->numberBetween(0,8) * 25,
            'duree' => fake()->numberBetween(2,10),
        ];
    }
}
