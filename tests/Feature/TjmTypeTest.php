<?php

use App\Models\Product;
use App\Models\TjmType;

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
