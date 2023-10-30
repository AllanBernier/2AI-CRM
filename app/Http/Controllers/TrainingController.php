<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingStoreRequest;
use App\Models\Company;
use App\Models\Product;
use App\Models\Subcontractor;
use App\Models\TjmType;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class TrainingController extends Controller
{


    public function all()
    {
        return new JsonResource(
            Training::
            with('product', 'customer', 'customer.company', 'subcontractor')
                ->orderBy('start_date')
                ->get()
        );
    }
    public function index(Request $request)
    {

        return Inertia::render('Training/Index', [
            'products' => Product::with('company')->get(),
            'subcontractors' => Subcontractor::all(),
            'filters' => $request->only(['search']),
        ]);
    }

    public function store(TrainingStoreRequest $request)
    {

        $training = Training::create($request->validated());
        return new JsonResource($training);
    }

    public function edit(Training $training, TrainingStoreRequest $request)
    {
        $training->update($request->validated());
        return new  JsonResource($training);
    }
}
