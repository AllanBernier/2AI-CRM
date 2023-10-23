<?php

use App\Models\Subcontractor;
use function Pest\Laravel\delete;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

test('i can create subcontractor', function () {
    $subcontractor_data = Subcontractor::factory()->make()->toArray();

    $response = post(route('subcontractors.store'), $subcontractor_data );

    $subcontractor = Subcontractor::first();
    expect($response->status())->toBe(201)
        ->and(Subcontractor::count())->toBe(1)
        ->and($subcontractor_data['first_name'])->toBe($subcontractor->first_name)
        ->and($subcontractor_data['last_name'])->toBe($subcontractor->last_name)
        ->and($subcontractor_data['email_perso'])->toBe($subcontractor->email_perso)
        ->and($subcontractor_data['email_company'])->toBe($subcontractor->email_company)
        ->and($subcontractor_data['phone'])->toBe($subcontractor->phone)
        ->and($subcontractor_data['company_name'])->toBe($subcontractor->company_name)
        ->and($subcontractor_data['city'])->toBe($subcontractor->city);
});

test('i can edit subcontractors', function () {
    $subcontractor_data = Subcontractor::factory()->create()->toArray();
    $subcontractor_data['company_name'] = "2aiConceptLTD";

    $response = put(route('subcontractors.edit', ['subcontractor' => $subcontractor_data['id']]), $subcontractor_data );

    expect($response->status())->toBe(200)
        ->and(Subcontractor::count())->toBe(1)
        ->and(Subcontractor::first()->company_name)->toBe('2aiConceptLTD');
});

test('i can delete subcontractors', function () {
    $to_delete = Subcontractor::factory()->create();
    Subcontractor::factory(5)->create();

    $response = delete(route('subcontractors.destroy', ['subcontractor' => $to_delete->id]));

    expect($response->status())->toBe(200)
        ->and(Subcontractor::count())->toBe(5);
});
