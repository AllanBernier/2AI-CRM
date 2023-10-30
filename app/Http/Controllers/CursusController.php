<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursusStoreRequest;
use App\Models\Cursus;
use Illuminate\Http\Resources\Json\JsonResource;

class CursusController extends Controller
{
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

