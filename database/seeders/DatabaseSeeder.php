<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'name' => 'allan',
            'email' => 'allan.bernier1@gmail.com',
            'password' => Hash::make('00000000'),
        ]);

        $m2i = Company::factory()->create(['name' => 'm2i']);
        $orsys = Company::factory()->create(['name' => 'orsys']);
        $ib = Company::factory()->create(['name' => 'ib']);

        Product::factory(10)->create(['company_id' => $m2i->id]);
        Product::factory(8)->create(['company_id' => $orsys->id]);
        Product::factory(5)->create(['company_id' => $ib->id]);

        Customer::factory(10)->create(['company_id' => $m2i->id]);
        Customer::factory(8)->create(['company_id' => $orsys->id]);
        Customer::factory(5)->create(['company_id' => $ib->id]);
    }
}
