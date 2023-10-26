<?php

use App\Models\Customer;
use App\Models\Product;
use App\Models\Subcontractor;
use App\Models\Training;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

test('it can create training', function () {
    $training_data = Training::factory()->make()->toArray();

    $response = post(route('trainings.store'), $training_data);

    $training = Training::first();
    expect($response->status())->toBe(201)
        ->and(Training::count())->toBe(1)
        ->and($training_data['status'])->toBe($training->status)
        ->and($training_data['product_id'])->toBe($training->product_id)
        ->and($training_data['customer_id'])->toBe($training->customer_id)
        ->and($training_data['subcontractor_id'])->toBe($training->subcontractor_id)
        ->and($training_data['tjm_client'])->toBe($training->tjm_client)
        ->and($training_data['tjm_subcontractor'])->toBe($training->tjm_subcontractor)
        ->and($training_data['duree'])->toBe($training->duree)
        ->and($training_data['start_date'])->toBe($training->start_date)
        ->and($training_data['end_date'])->toBe($training->end_date)
        ->and($training_data['num_session'])->toBe($training->num_session)
        ->and($training_data['num_bdc'])->toBe($training->num_bdc)
        ->and($training_data['location'])->toBe($training->location)
        ->and($training_data['travelling_expenses'])->toBe($training->travelling_expenses);

});


test('i can edit training', function () {
    $training_data = Training::factory()->create()->toArray();
    $training_data['duree'] = 48.0;

    $response = put(route('trainings.edit', ['training' => $training_data['id'] ]), $training_data);

    expect($response->status())->toBe(200)
        ->and(Training::first()->duree)->toBe(48.0);
});

test('trainings are linked with products', function () {
    $jvs = Product::factory()->create(['code' => 'JVS-ANGU']);
    $training = Training::factory()->create(['product_id' =>$jvs->id]);

    expect($training->product->code)->toBe($jvs->code);
});

test('trainings are linked with client', function () {
    $amanda = Customer::factory()->create(['first_name' => 'amanda']);
    $training = Training::factory()->create(['customer_id' =>$amanda->id]);

    expect($training->customer->first_name)->toBe($amanda->first_name);
});

test('trainings are linked with subcontractor', function () {
    $dylan = Subcontractor::factory()->create(['first_name' => 'dylan']);
    $training = Training::factory()->create(['subcontractor_id' =>$dylan->id]);

    expect($training->subcontractor->first_name)->toBe($dylan->first_name);
});





