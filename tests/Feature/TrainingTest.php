<?php

use App\Models\Customer;
use App\Models\Product;
use App\Models\Subcontractor;
use App\Models\TjmType;
use App\Models\Training;
use function Pest\Laravel\get;
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


test('When create training with product, set default duree, status, tjm_client , ', function () {
    $product = Product::factory()->create(['tjm' => 650, 'duree' => 6]);
    $training = Training::create(['product_id' => $product->id]);
    $training->refresh();
    expect($training->status)->toBe('nouveau')
        ->and($training->duree)->toBe(6.0)
        ->and($training->tjm_client)->toBe(650);
});


test('when create training with product, do not set duree or tjm_client if not null', function () {
    $product = Product::factory()->create(['tjm' => 650, 'duree' => 6]);
    $training = Training::create([
        'product_id' => $product->id,
        'duree' => 5,
        'tjm_client' => 600
    ]);
    $training->refresh();

    expect($training->status)->toBe('nouveau')
        ->and($training->duree)->toBe(5.0)
        ->and($training->tjm_client)->toBe(600);
});


test('when create training with product, only set duree & client fields if product has associated fields set', function () {
    $product = Product::create(['code' => 'toto']);
    $training = Training::create([
        'product_id' => $product->id,
    ]);
    $training->refresh();

    expect($training->status)->toBe('nouveau')
        ->and($training->duree)->toBe(null)
        ->and($training->tjm_client)->toBe(null);
});


test('When edit training also edit training tjm_subcontractor with product tjm_type and subcontractor tjm_type', function () {

    $init_tjm = TjmType::create(['name' => 'INIT']);
    $product = Product::create(['code' => 'toto','tjm_type_id' => $init_tjm->id]);
    $subcontractor = Subcontractor::factory()->create();
    $subcontractor->tjms()->updateExistingPivot($init_tjm->id, ['price' => 500]);
    $training = Training::create(['product_id' => $product->id]);
    $training_data = [
        'id' => $training->id,
        'subcontractor_id' => $subcontractor->id
    ];

    $response = put(route('trainings.edit', ['training' => $training_data['id'] ]), $training_data);
    $training->refresh();

    expect($training->tjm_subcontractor)->toBe(500);
});


test('when create training set duree && tjm_client only if product is set', function () {
    $training = Training::create(['num_bdc' => 'SE23-065694']);

    expect($training->duree)->toBe(null);
    expect($training->tjm_client)->toBe(null);
});


test('When edit training edit training subcontractor s tjm only if product is set', function () {

    $init_tjm = TjmType::create(['name' => 'INIT']);
    $subcontractor = Subcontractor::factory()->create();
    $subcontractor->tjms()->updateExistingPivot($init_tjm->id, ['price' => 500]);

    $training = Training::create();
    $training_data = [
        'id' => $training->id,
        'subcontractor_id' => $subcontractor->id
    ];

    $response = put(route('trainings.edit', ['training' => $training_data['id'] ]), $training_data);
    $training->refresh();

    expect($response->status())->toBe(200)
        ->and($training->tjm_subcontractor)->toBe(0);
});

test('when edit training edit training subcontractor tjm only if subcontractor is set', function () {
    $init_tjm = TjmType::create(['name' => 'INIT']);
    $product = Product::create(['code' => 'toto','tjm_type_id' => $init_tjm->id]);

    $training = Training::create(['product_id' => $product->id]);
    $training_data = [
        'id' => $training->id,
        'status' => 'option'
    ];

    $response = put(route('trainings.edit', ['training' => $training_data['id'] ]), $training_data);
    $training->refresh();

    expect($response->status())->toBe(200)
        ->and($training->tjm_subcontractor)->toBe(0);
});


test('default training tjm_subcontractor && tjm_client is 0', function () {
    $training = Training::create(['status' => 'nouveau']);

    $training->refresh();

    expect($training->tjm_client)->toBe(0)
        ->and($training->tjm_subcontractor)->toBe(0);

});


test('get all trainings with product, customer, customer.company, subcontractor', function () {
    Training::factory(5)->create();


    $response = get(route('trainings.all'));


    expect($response->status())->toBe(200)
        ->and(count($response->json('data')))->toBe(5)
        ->and(count($response->json('data.0.customer')))->not->toBe(null)
        ->and(count($response->json('data.0.customer.company')))->not->toBe(null)
        ->and(count($response->json('data.0.subcontractor')))->not->toBe(null)
        ->and(count($response->json('data.0.product')))->not->toBe(null);
});


test('training have text, action_customer and action_subcontractor field ', function () {
    $training_data = Training::factory()->make()->toArray();

    $response = post(route('trainings.store'), $training_data);

    $training = Training::first();
    expect($response->status())->toBe(201)
        ->and(Training::count())->toBe(1)
        ->and($training_data['text'])->toBe($training->text)
        ->and($training_data['action_customer'])->toBe($training->action_customer)
        ->and($training_data['action_subcontractor'])->toBe($training->action_subcontractor);
});


test('When creating training, also set training name equals to product code', function () {
    $jvs = Product::factory()->create(['code'=>'JVS-ANGU']);
    $training_data = [
        'product_id' => $jvs->id
    ];

    $response = post(route('trainings.store'), $training_data);

    expect($response->status())->toBe(201)
        ->and(Training::count())->toBe(1)
        ->and(Training::first()->name)->toBe($jvs->code);

});
