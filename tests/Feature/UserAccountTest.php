<?php

use App\Models\Subcontractor;
use App\Models\Training;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('user can be admin', function () {
    $user = User::factory()->create(['admin' => true]);

    expect($user->admin)->toBe(true);
});

test('user can be linked to subcontractor_id', function () {
    $subcontractor = Subcontractor::factory()->create();

    $user = User::factory()->create(['subcontractor_id' => true]);

    expect($user->subcontractor->first_name)->toBe($subcontractor->first_name);

});


function logAsNewSubcontractor()
{
    $subcontractor = Subcontractor::factory()->create();
    $user = User::factory()->create(['subcontractor_id' => $subcontractor->id]);
    Auth::login($user);

    return $user;
}

test('i can retrieve all my trainings in options', function () {
    $user = logAsNewSubcontractor();

    Training::factory(2)->create(['status' => 'option']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'nouveau']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'option']);

    $response = get(route('subcontractors.trainings.options'));

    expect($response->json('data'))->toHaveCount(2);
});

test('i can retrieve all my trainings with status "nouveau" & action subcontractor solliciter', function () {
    $user = logAsNewSubcontractor();

    Training::factory(2)->create(['status' => 'option']);
    Training::factory(4)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'nouveau', 'action_subcontractor' => 'solliciter']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'option', 'action_subcontractor' => 'solliciter']);

    $response = get(route('subcontractors.trainings.new'));

    expect($response->json('data'))->toHaveCount(4);
})->only();

test('i can retrieve all my trainings by month & year that is option or confirmé', function () {
    $user = logAsNewSubcontractor();

    Training::factory(2)->create(['status' => 'option']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'nouveau', 'start_date' => '2023-11-22'] );
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'option', 'start_date' => '2023-11-18']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'confirmé', 'start_date' => '2022-11-22']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'option', 'start_date' => '2023-10-22']);

    $response = post(route('subcontractors.trainings.month'), [
        'year' => 2023,
        'month' => 11
    ]);

    expect($response->json('data'))->toHaveCount(4);
});


test('i can retrieve all my trainings that is option or confirmé', function () {
    $user = logAsNewSubcontractor();

    Training::factory(2)->create(['status' => 'option']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'nouveau', 'start_date' => '2023-11-22'] );
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'option', 'start_date' => '2023-11-18']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'confirmé', 'start_date' => '2022-11-22']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'option', 'start_date' => '2023-10-22']);

    $response = get(route('subcontractors.trainings.index'));

    expect($response->json('data'))->toHaveCount(8);
});


test('i can retrieve all my trainings that need an ar bdc confirmation', function () {
    $user = logAsNewSubcontractor();

    Training::factory(2)->create(['status' => 'option']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'nouveau'] );
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'option']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'confirmé']);
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'option', 'action_subcontractor' => 'Envoyer BDC']);

    $response = get(route('subcontractors.trainings.toconfirm'));

    expect($response->json('data'))->toHaveCount(2);

});


test('i can retrieve all my trainings incoming or ended lasth month that have status option or confirmé or annulé', function () {
    $user = logAsNewSubcontractor();

    Training::factory(2)->create(['status' => 'option']);
    Training::factory(1)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'nouveau', 'end_date' => Carbon::now()->addMonth(2)->format('Y-m-d')] );
    Training::factory(2)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'option', 'end_date' => Carbon::now()->subMonth(3)->format('Y-m-d')]);
    Training::factory(3)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'annulé', 'end_date' => Carbon::now()->addMonth(2)->format('Y-m-d')]);
    Training::factory(4)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'confirmé', 'end_date' => Carbon::now()->subDay(5)->format('Y-m-d')]);
    Training::factory(5)->create(['subcontractor_id' => $user->subcontractor->id ,'status' => 'option', 'end_date' => Carbon::now()->subDay(10)->format('Y-m-d')]);

    $response = get(route('subcontractors.trainings.incoming'));

    expect($response->json('data'))->toHaveCount(12);
})->only();
