<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invoice;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceCompanyController extends Controller
{
    public function index()
    {
        return Inertia::render('InvoiceCompany/Index');
    }

    public function billing(Company $company)
    {

        $trainings = Training::whereHas('customer', function (Builder $query) use ($company) {
                $query->where('company_id', $company->id);
            })
            ->whereNull('company_invoice_id')
            ->where('end_date', '<', Carbon::today()->addDays(10)->format('Y-m-d'))
            ->with('subcontractor')
            ->get();
        return new JsonResource( $trainings );
    }

    public function showBdc(Training $training)
    {
        if (!isset( $training->bdc_file)){
            abort(403);
        }
        if (!Storage::fileExists($training->bdc_file)){
            abort(403);
        }

        return response()->file(Storage::path($training->bdc_file));

    }

    public function store(Request $request)
    {
        if (!isset( $request['trainings'])){
            abort(403);
        }
        $query_trainings = Training::query()->whereIn('id', $request['trainings']);

        $trainings = $query_trainings->get();
        $invoice = Invoice::create([
            'company_id' => $trainings[0]->customer->company->id,
            'file' => Str::uuid(),
            'total' => Training::query()->whereIn('id', $request['trainings'])->select(DB::raw('sum((tjm_client + travelling_expenses) * duree) as total'))->first()->total
        ]);

        $query_trainings->update(['company_invoice_id' => $invoice->id]);

        $invoice->load('company', 'trainings');
        $pdf = Pdf::loadView('pdf.invoice', $invoice->toArray());
        Storage::put($invoice->file,$pdf->download()->getOriginalContent()) ;

        return new JsonResource($invoice);
    }

    public function showInvoice(Invoice $invoice)
    {
        if (!isset( $invoice->file )){
            abort(403);
        }
        if (!Storage::fileExists( $invoice->file )){
            abort(403);
        }

        return response()->file(Storage::path( $invoice->file ));
    }

    public function paginated(Company $company)
    {
        return new JsonResource(
            Invoice::query()->where('company_id', $company->id)->withCount('trainings')->paginate(5)
        );
    }

    public function delete(Invoice $invoice)
    {
        $invoice->trainings()->update(['company_invoice_id' => null]);
        $invoice->delete();
        return new JsonResource($invoice);
    }

}

