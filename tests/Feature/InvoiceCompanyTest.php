<?php


use App\Models\Company;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('i can search all trainings from a company that have no company_invoice_id && due_date end_date is done in less than a week', function () {
    $m2i = Company::factory()->create(['name' => 'm2i']);
    $ib = Company::factory()->create(['name' => 'ib']);
    $barbara = Customer::factory()->create(['company_id' => $m2i->id]);
    $agnes = Customer::factory()->create(['company_id' => $m2i->id]);
    $nathalie = Customer::factory()->create(['company_id' => $ib->id]);
    // end_date in the past
    Training::factory(3)->create(['customer_id' => $barbara->id, 'company_invoice_id' => null,  'end_date' => Carbon::today()->addDays(rand(-10, -50))->format('Y-m-d')]);
    // end_date in coming
    Training::factory(2)->create(['customer_id' => $agnes->id, 'company_invoice_id' => null, 'end_date' => Carbon::today()->addDays(3)->format('Y-m-d')]);
    // en date in the future
    Training::factory(2)->create(['customer_id' => $agnes->id, 'company_invoice_id' => null, 'end_date' => Carbon::today()->addDays(rand(20, 150))->format('Y-m-d')]);
    // company_invoice_id not null
    Training::factory(2)->create(['customer_id' => $agnes->id]);
    // Another company
    Training::factory(2)->create(['customer_id' => $nathalie->id, 'company_invoice_id' => null]);

    $response = get(route('invoices.company.billing', ['company' => $m2i->id]));

    expect($response->json('data'))->toHaveCount(5);

});

test('i can show pdf', function () {
    Storage::fake();
    $jvs = Training::factory()->create(['bdc_file' => Str::uuid()]);

    Storage::put($jvs->bdc_file , file_get_contents(UploadedFile::fake()->create('avatar.pdf')));

    $response = get(route('invoice.company.show.bdc', ['training' => $jvs->id]));
    $response->assertStatus(200);
});


test('i can create invoice from multiple trainings', function () {
    Storage::fake();
    $m2i = Company::factory()->create(['name' => 'm2i']);
    $barbara = Customer::factory()->create(['company_id' => $m2i]);
    $trainings = Training::factory(3)->create(['customer_id' => $barbara->id]);

    $response = post(route('invoice.company.store'), ['trainings' => [
        $trainings[0]->id,
        $trainings[1]->id,
        $trainings[2]->id,
    ]]);
    $invoice = Invoice::first();

    expect($response->status())->toBe(201)
        ->and(Invoice::count())->toBe(1)
        ->and($invoice->company->name)->toBe($m2i->name)
        ->and($invoice->trainings)->toHaveCount(3)
        ->and($invoice->file)->not->toBe(null);
    Storage::assertExists($invoice->file);
});

test('i can show invoice pdf', function () {
    Storage::fake();
    $m2i = Company::factory()->create(['name' => 'm2i']);
    $barbara = Customer::factory()->create(['company_id' => $m2i]);
    $trainings = Training::factory(3)->create(['customer_id' => $barbara->id]);
    post(route('invoice.company.store'), ['trainings' => [ $trainings[0]->id, $trainings[1]->id, $trainings[2]->id]]);
    $invoice = Invoice::first();

    $response = get(route('invoice.company.show.invoice', ['invoice' => $invoice->id]));

    $response->assertStatus(200);
});

test('i can get paginated invoice by company', function () {
    $m2i = Company::factory()->create(['name' => 'm2i']);
    Invoice::factory(16)->create(['company_id' => $m2i->id]);

    $response = get(route('invoice.company.paginated', $m2i->id));

    expect($response->status())->toBe(200)
        ->and($response->json('total'))->toBe(16);
});


test('i can delete invoice it also delete invoice attach', function () {
    $m2i = Company::factory()->create(['name' => 'm2i']);
    $barbara = Customer::factory()->create(['company_id' => $m2i]);
    $trainings = Training::factory(3)->create(['customer_id' => $barbara->id]);
    post(route('invoice.company.store'), ['trainings' => [ $trainings[0]->id, $trainings[1]->id, $trainings[2]->id]]);
    $invoice = Invoice::first();

    $response = delete(route('invoice.company.destroy', $invoice->id));

    expect($response->status())->toBe(200)
        ->and(Invoice::count())->toBe(0)
        ->and(Training::first()->company_invoice_id)->toBe(null);

});


test('when creating invoice, total field is equal to sum of tjm_customer + travelling_expenses * duree of each trainings', function () {
    Storage::fake();
    $m2i = Company::factory()->create(['name' => 'm2i']);
    $barbara = Customer::factory()->create(['company_id' => $m2i->id]);
    $training_1 = Training::factory()->create(['customer_id' => $barbara->id, 'tjm_client' => 600, 'duree' => 3]); // 1800
    $training_2 = Training::factory()->create(['customer_id' => $barbara->id, 'tjm_client' => 200, 'duree' => 2]); // 400
    $training_3 = Training::factory()->create(['customer_id' => $barbara->id, 'tjm_client' => 100, 'duree' => 3, 'travelling_expenses' => 100]); // 600

    $response = post(route('invoice.company.store'), ['trainings' => [
        $training_1->id,
        $training_2->id,
        $training_3->id,
    ]]);

    expect($response->status())->toBe(201)
        ->and(Invoice::first()->total)->toBe(2800);
});

test('when creating invoices, increments invoices number', function () {
    $invoice_first = Invoice::factory()->create();
    $invoice_second = Invoice::factory()->create();

    $invoice_first->refresh();
    $invoice_second->refresh();

    expect($invoice_first->num)->toBe($invoice_second-> num -1);
});
