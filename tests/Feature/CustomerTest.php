<?php

use App\Models\Company;
use App\Models\Customer;
use App\Models\User;
use Inertia\Testing\Assert;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->logAsNewUser();
});

test('customer page is displayed', function () {
    $response = $this->get(route('customers.index'));

    $response->assertOk();
});

test('i can add customer', function () {
    $customer_array = Customer::factory()->make()->toArray();

    $response = post(route("customers.store"), $customer_array);

    expect($response->status())->toBe(201);
    $customer = Customer::first();
    expect(Customer::count())->toBe(1)
        ->and($customer_array['first_name'])->toBe($customer->first_name)
        ->and($customer_array['last_name'])->toBe($customer->last_name)
        ->and($customer_array['role'])->toBe($customer->role)
        ->and($customer_array['phone'])->toBe($customer->phone)
        ->and($customer_array['email'])->toBe($customer->email)
        ->and($customer_array['city'])->toBe($customer->city);
});

test('customer can be linked to company', function () {
    $company = Company::factory()->create(['name' => 'm2i']);
    $customer = Customer::factory()->create(['company_id' => $company->id]);

    expect($customer->company->name)->toBe('m2i');
    expect($company->customers()->count())->toBe(1);
});

test('i can add customer linked to company', function () {
    $customer_array = Customer::factory()->make()->toArray();
    $customer_array['company_id'] = Company::factory()->create(['name'=> 'm2i'])->id;

    $response = post(route("customers.store"), $customer_array);

    expect($response->status())->toBe(201)
        ->and(Customer::count())->toBe(1)
        ->and(Customer::first()->company->name)->toBe('m2i');
});
