<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $m2i = Company::factory()->create(['name' => 'm2i']);
        $orsys = Company::factory()->create(['name' => 'orsys']);
        $ib = Company::factory()->create(['name' => 'ib']);

        Customer::factory(10)->create(['company_id' => $m2i->id]);
        Customer::factory(8)->create(['company_id' => $orsys->id]);
        Customer::factory(5)->create(['company_id' => $ib->id]);

    }
}
