<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursusStoreRequest;
use App\Models\Cursus;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class CursusController extends Controller
{

    public function index()
    {
        return Inertia::render('Cursus/Index', [
            'cursuses' => Cursus::with('trainings','trainings.subcontractor', 'product', 'customer')->get()->sortBy('created_at'),
        ]);
    }
    public function store(CursusStoreRequest $request)
    {
        $cursus = Cursus::create($request->validated());
        return new JsonResource($cursus);
    }

    public function edit(Cursus $cursus, CursusStoreRequest $request)
    {
        $cursus->update($request->validated());
        return new JsonResource($cursus);
    }
}

