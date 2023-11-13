<?php

use App\Models\Subcontractor;
use App\Models\Training;
use Carbon\Carbon;
use function Pest\Laravel\get;

test('i can get all subcontractor who made training in month ? and corresponding tranings', function () {
    $s1 = Subcontractor::factory()->create();
    $s2 = Subcontractor::factory()->create();
    $s2 = Subcontractor::factory()->create();

    Training::factory(1)->create(['subcontractor_id'=>$s1->id, 'end_date' => Carbon::now()->format('Y-m-d')]);
    Training::factory(2)->create(['subcontractor_id'=>$s2->id, 'end_date' => Carbon::now()->format('Y-m-d')]);
    Training::factory(3)->create(['subcontractor_id'=>$s1->id, 'end_date' => Carbon::now()->subMonth(5)->format('Y-m-d')]);
    Training::factory(4)->create(['subcontractor_id'=>$s2->id, 'end_date' => Carbon::now()->subMonth(5)->format('Y-m-d')]);

    $response = get(route('invoices.subcontractors', ['month' => Carbon::now()->month, 'year' => Carbon::now()->year]));

    expect($response->status())->toBe(200)
        ->and($response->json('data'))->toHaveCount(2)
        ->and($response->json('data.0.trainings'))->toHaveCount(1)
        ->and($response->json('data.1.trainings'))->toHaveCount(2);
});

