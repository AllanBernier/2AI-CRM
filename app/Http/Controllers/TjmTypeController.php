<?php

namespace App\Http\Controllers;

use App\Models\Subcontractor;
use App\Models\TjmType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TjmTypeController extends Controller
{
    public function edit(Subcontractor $subcontractor, TjmType $tjmType, Request $request)
    {
        if (!$request->has('price')){
            abort(403);
        }

        $subcontractor->tjms()->updateExistingPivot($tjmType->id, ['price' => $request->price]);

        return new JsonResource($subcontractor->tjms);
    }
}
