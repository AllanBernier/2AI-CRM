<?php

namespace App\Http\Controllers;

use App\Models\Subcontractor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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
}
