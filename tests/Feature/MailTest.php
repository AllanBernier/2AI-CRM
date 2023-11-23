<?php

use App\Mail\ARNouveau;
use App\Models\Training;
use Illuminate\Support\Facades\Mail;
use function Pest\Laravel\post;

test('i can send AR Nouveau mail', function () {
    Mail::fake();
    $training = Training::factory()->create();

    $response = post(route('trainings.mail', ['training' => $training->id]), ['action_customer' => 'AR Nouveau']);


    $training->refresh();

    expect($response->status())->toBe(200)
    ->and($training->action_customer)->toBe('AR Nouveau');
    Mail::assertQueued(ARNouveau::class, function ($mail) use ($training) {
        return $mail->hasTo($training->customer->email);
    });

});
