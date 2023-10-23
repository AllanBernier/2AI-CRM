<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingStoreRequest;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingController extends Controller
{
    public function store(TrainingStoreRequest $request)
    {
        $training = Training::create($request->validated());
        return new JsonResource($training);
    }
}
