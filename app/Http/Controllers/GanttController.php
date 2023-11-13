<?php

namespace App\Http\Controllers;

use App\Models\Subcontractor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class GanttController extends Controller
{

    public function index()
    {
        return Inertia::render('Gantt/Index');
    }

    public function show(Request $request)
    {
        if (!(isset($request['start_date']) && isset($request['end_date']))){
            abort(403);
        }

        return new JsonResource(
            Subcontractor::whereHas('trainings', function (Builder $query) use ($request) {
                $query->whereBetween('start_date', [$request['start_date'], $request['end_date']]);
                $query->orWhereBetween('end_date', [$request['start_date'], $request['end_date']]);
            })->with(["trainings" => function($query) use ($request) {
                $query->whereBetween('start_date', [$request['start_date'], $request['end_date']]);
                $query->orWhereBetween('end_date', [$request['start_date'], $request['end_date']]);
            }])->get()
        );

    }
}
