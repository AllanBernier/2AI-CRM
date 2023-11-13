<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceStoreRequest;
use App\Models\Subcontractor;
use App\Models\Training;
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
                $query->whereDate('end_date', '>=', $date->firstOfMonth()->format('Y-m-d'));
                $query->whereDate('end_date', '<=', $date->lastOfMonth()->format('Y-m-d'));
            })->with(["trainings" => function($query) use ($date) {
                $query->whereDate('end_date', '>=', $date->firstOfMonth()->format('Y-m-d'));
                $query->whereDate('end_date', '<', $date->lastOfMonth()->format('Y-m-d'));
            }])
            ->with('trainings.subcontractor')
            ->get()
        );
    }

    public function store(Request $request)
    {
        if (!$request['file_content'] || !$request['trainings']){
            abort(403);
        }
        $uuid = Str::uuid() ;
        Storage::put($uuid , file_get_contents($request['file_content']));
        Training::query()->whereIn('id', explode(",", $request['trainings']))->update(['invoice_file' => $uuid]);

        return new JsonResource(['message' => 'file uploaded']);
    }

}


