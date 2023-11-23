<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Subcontractor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $date = Carbon::today()->addDays(rand(0, 150));

        return [
            'status' => fake()->randomElement(['nouveau', 'confirmé', 'option', 'annulé']),
            'product_id' => Product::factory()->create(['company_id' => $company->id]),
            'customer_id' => Customer::factory()->create(['company_id' => $company->id]),
            'subcontractor_id' => Subcontractor::factory()->create(),
            'tjm_client' => 600 + fake()->numberBetween(0,4) * 25,
            'tjm_subcontractor' => 300 + fake()->numberBetween(0,8) * 25,
            'duree' => fake()->randomFloat(1,1,5),
            'start_date' => $date->format('Y-m-d'),
            'end_date' => $date->addDays(rand(1, 5))->format('Y-m-d'),
            'num_session' => fake()->postcode,
            'num_bdc' => fake()->postcode,
            'location' => fake()->city,
            'travelling_expenses' => 0,
            'text' => fake()->text(20),
            'action_customer' =>  fake()->randomElement(['ar Nouveau', 'envoyé intervenant', 'relance option', 'ar bdc', 'envoyé changement sur option', 'envoyé changement sur confirmation', 'envoyé refus']),
            'action_subcontractor' =>  fake()->randomElement(['solliciter', 'solliciter dates', 'envoyé bon d\'option', 'bon pour accord', 'annuler une option', 'annuler une confirmation']),
            'company_invoice_id' => Str::ulid()->toBase32(),
            'company_invoice_status' => fake()->randomElement(['vérifié', 'erreur bdc']),
            'bdc_file' => Str::ulid()->toBase32(),
        ];
    }
}
