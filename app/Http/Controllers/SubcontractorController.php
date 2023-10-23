<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubcontractorStoreRequest;
use App\Models\Subcontractor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Js;
use Inertia\Inertia;

class SubcontractorController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Subcontractor/Index', [
            'subcontractors' => Subcontractor::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->tokenizedSearch($search, [
                        'first_name',
                        'last_name',
                        'email_perso',
                        'company_name',
                        'city',
                        'phone'
                    ]);
                })
                ->orderBy('company_name')
                ->get(),
            'filters' => $request->only(['search']),
        ]);
    }

    public function store(SubcontractorStoreRequest $request)
    {
        $subcontractor = Subcontractor::create($request->validated());
        return new JsonResource($subcontractor);
    }

    public function edit(Subcontractor $subcontractor, SubcontractorStoreRequest $request)
    {
        $subcontractor->update($request->validated());
        return new JsonResource($subcontractor);
    }

    public function destroy(Subcontractor $subcontractor)
    {
        $subcontractor->delete();
        return new JsonResource($subcontractor);
    }
}
