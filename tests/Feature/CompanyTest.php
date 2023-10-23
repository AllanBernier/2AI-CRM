<?php

use App\Models\Company;
use function Pest\Laravel\get;

it('can get all company', function () {
    Company::factory(3)->create();

    $response = get(route("companies.index"));

    expect(count($response->json('data')))->toBe(3);
});
