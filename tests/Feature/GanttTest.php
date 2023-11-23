<?php

use App\Models\Product;
use App\Models\Subcontractor;
use App\Models\Training;
use function Pest\Laravel\post;

test('i can recieve all trainers with corresponding training in new, option, confirmé between start and end date', function () {
    Training::factory(2)->create(['status' => 'nouveau', 'start_date' => '2023-11-22']);
    Training::factory(2)->create(['status' => 'option', 'start_date' => '2023-11-22']);
    Training::factory(2)->create(['status' => 'confirmé', 'start_date' => '2023-11-22']);
    Training::factory(2)->create(['status' => 'confirmé', 'end_date' => '2023-11-25']);

    Training::factory(2)->create(['status' => 'confirmé', 'start_date' => '2023-10-10', 'end_date' => '2024-01-01']);
    Training::factory(2)->create(['status' => 'annulé', 'start_date' => '2023-12-15', 'end_date' => '2024-01-01']);

    $response = post(route('gantt.show', ['start_date' => '2023-11-01', 'end_date' => '2023-12-01']));

    expect($response->status())->toBe(200)
        ->and($response->json('data'))->toHaveCount(8);

});


test('i can search all subcontractors that are linked with product', function () {
    $product = Product::factory()->create();
    $toto = Subcontractor::factory()->create();
    $titi = Subcontractor::factory()->create();
    $tata = Subcontractor::factory()->create();
    $toto->products()->attach($product);
    $tata->products()->attach($product);

    $response = post(route('gantt.search', ['product' => $product->id, 'start_date' => '2023-11-01', 'end_date' => '2023-12-01']));

    expect($response->status())->toBe(200)
        ->and($response->json('data'))->toHaveCount(2);
});
