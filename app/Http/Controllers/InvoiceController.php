<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceStoreRequest;
use App\Models\Subcontractor;
use App\Models\Training;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    public function index()
    {
        return Inertia::render('Invoice/Index');
    }


    public function subcontractors(String $month, String $year)
    {

        $date = Carbon::now()->setMonth($month)->setYear($year);



        return new JsonResource(
            Subcontractor::whereHas('trainings', function (Builder $query) use ($date) {
                $query->whereBetween('end_date', [$date->firstOfMonth()->format('Y-m-d'),$date->lastOfMonth()->format('Y-m-d')] );
            })->with(["trainings" => function($query) use ($date) {
                $query->whereBetween('end_date', [$date->firstOfMonth()->format('Y-m-d'),$date->lastOfMonth()->format('Y-m-d')]);
                $query->with('subcontractor');
            }])
            ->get()
        );
    }

    public function store(Request $request)
    {
        if (!$request['trainings'] || !$request['invoice_number']){
            abort(403);
        }

        $uuid = Str::uuid();
        $trainings_query = Training::query()->whereIn('id', $request['trainings']);
        $trainings_query->update(['invoice_file' => $uuid]);

        $pdf = Pdf::loadView('pdf.invoice_subcontractor', [
            'trainings' => $trainings_query->get()->toArray(),
            'invoice_number' => $request['invoice_number']
        ]);
        Storage::put($uuid ,$pdf->download()->getOriginalContent());

        return new JsonResource(['message' => 'file created']);
    }

    public function show(Training $training)
    {
        if (!isset( $training->invoice_file )){
            abort(403);
        }
        if (!Storage::fileExists( $training->invoice_file )){
            abort(403);
        }

        return response()->file(Storage::path( $training->invoice_file ));

    }


}


