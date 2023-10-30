<?php

use App\Models\Subcontractor;
use App\Models\TjmType;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
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


test('when creating new subcontractor, also create link to each tjm_types and default value to 0', function () {
    TjmType::factory(3)->create();
    $subcontractor = Subcontractor::factory()->create();
    expect($subcontractor->tjms->count())->toBe(3)
        ->and($subcontractor->tjms->first()->pivot->price)->toBe(0);
});



test('get all subcontractors', function () {
    Subcontractor::factory(4)->create();

    $response = get(route('subcontractors.all'));

    expect($response->status())->toBe(200)
        ->and(count($response->json('data')))->toBe(4);
});


test('subcontractor can have subcontractor', function () {

    $mechety = Subcontractor::factory()->create();

    $subcontractor_data = Subcontractor::factory()->make()->toArray();
    $subcontractor_data['subcontractor_id'] = $mechety->id;

    $response = post(route('subcontractors.store'), $subcontractor_data );

    $subcontractor = Subcontractor::query()->whereFirstName($subcontractor_data['first_name'])->first();
    expect($response->status())->toBe(201)
        ->and(Subcontractor::count())->toBe(2)
        ->and($subcontractor_data['subcontractor_id'])->toBe($subcontractor->subcontractor_id)
        ->and($subcontractor->leader->first_name)->toBe($mechety->first_name);

});
