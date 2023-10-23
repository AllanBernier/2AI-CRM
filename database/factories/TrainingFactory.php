<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Subcontractor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Training>
 */
class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company = Company::factory()->create();

        return [
            'status' => fake()->randomElement(['nouveau', 'confirmé', 'option', 'archivé']),
            'product_id' => Product::factory()->create(['company_id' => $company->id]),
            'client_id' => Customer::factory()->create(['company_id' => $company->id]),
            'subcontractor_id' => Subcontractor::factory()->create(),
            'tjm_client' => fake()->numberBetween(500,600),
            'tjm_subcontractor' => fake()->numberBetween(600,700),
            'duree' => fake()->randomFloat(1,1,20),
            'start_date' => fake()->dateTimeThisMonth()->format('Y-m-d'),
            'end_date' => fake()->dateTimeThisMonth()->format('Y-m-d'),
            'num_session' => fake()->postcode,
            'num_bdc' => fake()->postcode,
            'travelling_expenses' => 0,
        ];
    }
}
