<?php

use App\Models\Training;
use function Pest\Laravel\post;

test('it can create training', function () {
    $training_data = Training::factory()->make()->toArray();

    $response = post(route('trainings.store'), $training_data);

    expect($response->status())->toBe(201);
});
