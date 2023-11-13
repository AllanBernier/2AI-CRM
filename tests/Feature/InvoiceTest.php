<?php

use App\Models\Subcontractor;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('i can get all subcontractor who made training in month ? and corresponding tranings', function () {
    $s1 = Subcontractor::factory()->create();
    $s2 = Subcontractor::factory()->create();
    Subcontractor::factory()->create();

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

test('i can link subcontractor invoice to multiple trainings', function () {
    Storage::fake();
    $christophe = Subcontractor::factory()->create();
    $trainings = Training::factory(2)->create(['subcontractor_id'=>$christophe->id, 'end_date' => Carbon::now()->format('Y-m-d')]);


    $data = [
        'trainings' => $trainings[0]->id .','. $trainings[1]->id,
        'file_content' => UploadedFile::fake()->create('avatar.pdf')
    ];

    $response = post(route('invoices.store'), $data);

    $trainings[0]->refresh();
    $trainings[1]->refresh();

    expect($response->status())->toBe(200)
        ->and($trainings[0]->invoice_file)->not->toBe(null)
        ->and($trainings[1]->invoice_file)->not->toBe(null);
    Storage::assertExists($trainings[0]->invoice_file);
});
