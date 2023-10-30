<?php

use App\Models\Company;
use App\Models\Cursus;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Training;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

test('i can create cursus with name', function () {
    $cursus_data = [
        'name' => 'POE JAVA BORDEAUX 4 DEC'
    ];

    $response = post(route('cursuses.store'), $cursus_data);

    expect($response->status())->toBe(201)
        ->and(Cursus::count())->toBe(1)
        ->and(Cursus::first()->name)->toBe($cursus_data['name']);

});

test('i can edit cursus', function () {
    $m2i = Company::create(['name'=>'m2i']);
    $cursus = Cursus::create(['name' => 'POE JAVA BORDEAUX 4 DEC']);

    $poe_data = [
        'product_id' => Product::factory()->create(['code' => 'POE JAVA', 'company_id' => $m2i->id])->id,
        'customer_id' => Customer::factory()->create(['company_id' => $m2i->id])->id,
        'tjm' => 550,
        'travelling_expenses' => 180,
        'location' => 'Paris la défense',
        'status' => 'staffing',
        'send_to_customer' => fake()->date,
        'send_to_subcontractors' => fake()->date,
    ];

    $response = put(route('cursuses.edit', $cursus->id), $poe_data);

    $cursus->refresh();
    expect($response->status())->toBe(200)
        ->and(Cursus::count())->toBe(1)
        ->and($cursus->product_id)->toBe($poe_data['product_id'])
        ->and($cursus->customer_id)->toBe($poe_data['customer_id'])
        ->and($cursus->tjm)->toBe($poe_data['tjm'])
        ->and($cursus->travelling_expenses)->toBe($poe_data['travelling_expenses'])
        ->and($cursus->location)->toBe($poe_data['location'])
        ->and($cursus->status)->toBe($poe_data['status'])
        ->and($cursus->send_to_customer)->toBe($poe_data['send_to_customer'])
        ->and($cursus->send_to_subcontractors)->toBe($poe_data['send_to_subcontractors']);
});


test('i can link training and cursus', function () {
    $cursus = Cursus::create(['name' => 'POE JAVA BORDEAUX 4 DEC']);
    $trainings = Training::factory(4)->create(['cursus_id' => $cursus->id]);

    expect($cursus->trainings()->count())->toBe(4)
        ->and($trainings[0]->cursus->id)->toBe($cursus->id);
});


test('can link training and cursus only if product_id, customer_id is set on cursus', function () {
    $cursus = Cursus::create(['name' => 'POE JAVA BORDEAUX 4 DEC']);

    expect(post(route('trainings.store'), ['text' => 'Html/Css les fondamentaux', 'cursus_id' => $cursus->id])->status())->toBe(403);

    $cursus->product_id = Product::factory()->create()->id;
    $cursus->save();

    expect(post(route('trainings.store'), ['text' => 'Html/Css les fondamentaux', 'cursus_id' => $cursus->id])->status())->toBe(403);

    $cursus->customer_id = Customer::factory()->create()->id;
    $cursus->save();

    expect(post(route('trainings.store'), ['text' => 'Html/Css les fondamentaux', 'cursus_id' => $cursus->id])->status())->toBe(201);

});


test('when create training from cursus also set product_id and customer_id ', function () {
    $cursus = Cursus::create([
        'name' => 'POE JAVA BORDEAUX 4 DEC',
        'product_id' => Product::factory()->create()->id,
        'customer_id' => Customer::factory()->create()->id
    ]);

    $response = post(route('trainings.store'), ['text' => 'Html/Css les fondamentaux', 'cursus_id' => $cursus->id]);

    $training = Training::first();
    expect($response->status())->toBe(201)
        ->and(Training::count())->toBe(1)
        ->and($training->customer_id)->toBe($cursus->customer_id)
        ->and($training->product_id)->toBe($cursus->product_id);

});
