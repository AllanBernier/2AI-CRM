<?php

use App\Models\Product;
use App\Models\Subcontractor;
use App\Models\TjmType;
use function Pest\Laravel\put;

test('i can create TJM(s)', function () {
    TjmType::factory()->create([
        'name' => 'TJM POE'
    ]);

    expect(TjmType::count())->toBe(1)
        ->and(TjmType::first()->name)->toBe('TJM POE');
});

test('Product can be linked with tjm', function () {
    $tjm_poe = TjmType::factory()->create(['name'=> 'TJM POE']);
    $poe_java = Product::factory()->create(['tjm_type_id' => $tjm_poe->id]);

    expect($poe_java->tjm_type->name)->toBe('TJM POE');
});

test('i can edit subcontractor tjm_type value', function () {
    $tjm_poe = TjmType::factory()->create(['name'=> 'TJM POE']);
    $others_tjms = TjmType::factory(5)->create();
    $contractor = Subcontractor::factory()->create();

    $response = put(route('tjms.edit', ['subcontractor' => $contractor->id, 'tjm_type' => $tjm_poe->id]), ['price' => 500]);

    expect($response->status())->toBe(200)
        ->and($contractor->tjms->count())->toBe(6)
        ->and($contractor->tjms()->find($tjm_poe->id)->pivot->price)->toBe(500);
})->only();
