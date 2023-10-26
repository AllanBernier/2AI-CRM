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
            'customer_id' => Customer::factory()->create(['company_id' => $company->id]),
            'subcontractor_id' => Subcontractor::factory()->create(),
            'tjm_client' => 600 + fake()->numberBetween(0,4) * 25,
            'tjm_subcontractor' => 300 + fake()->numberBetween(0,8) * 25,
            'duree' => fake()->randomFloat(1,1,5),
            'start_date' => fake()->dateTimeThisMonth()->format('Y-m-d'),
            'end_date' => fake()->dateTimeThisMonth()->format('Y-m-d'),
            'num_session' => fake()->postcode,
            'num_bdc' => fake()->postcode,
            'location' => fake()->city,
            'travelling_expenses' => 0,
        ];
    }
}
