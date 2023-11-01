<?php

namespace App\Http\Controllers\Subcontractors;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingDateRequest;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SubcontractorTrainingController extends Controller
{


    public function index()
    {
        $sub_id = Auth::user()->subcontractor->id;
        $query = Training::query();
        $query->where('subcontractor_id', $sub_id);
        $query->orderBy('start_date');

        return new JsonResource(
            $query->get()
        );
    }

    public function options()
    {
        $sub_id = Auth::user()->subcontractor->id;

        return new JsonResource(
            Training::query()->where('subcontractor_id', $sub_id)->where('status','option')->get()
        );
    }

    public function new(Request $request)
    {
        $sub_id = Auth::user()->subcontractor->id;

        return new JsonResource(
            Training::query()
                ->where('subcontractor_id', $sub_id)
                ->where('action_subcontractor', 'solliciter')
                ->where('status','nouveau')->get()
        );
    }

    public function month(TrainingDateRequest $request)
    {
        $data = $request->validated();

        $sub_id = Auth::user()->subcontractor->id;
        $query = Training::query();
        $query->where('subcontractor_id', $sub_id);
        $query->whereMonth('start_date',$data['month']);
        $query->whereYear('start_date',$data['year']);
        $query->orderBy('start_date');

        return new JsonResource(
            $query->get()
        );
    }

    public function toconfirm()
    {
        $sub_id = Auth::user()->subcontractor->id;
        $query = Training::query();
        $query->where('subcontractor_id', $sub_id);
        $query->where('status', 'option');
        $query->where('action_subcontractor', 'Envoyer BDC');
        $query->orderBy('start_date');

        return new JsonResource(
            $query->get()
        );
    }

    public function incoming()
    {
        $sub_id = Auth::user()->subcontractor->id;
        $query = Training::query();
        $query->where('subcontractor_id', $sub_id);
        $query->where(function($query) {
            $query->where('status', 'option');
            $query->orWhere('status', 'confirmé');
            $query->orWhere('status', 'annulé');
        });
        $query->whereDate('end_date', '>=', Carbon::now()->subMonth(1)->format('Y-m-d'));
        $query->orderBy('start_date');

        return new JsonResource(
            $query->get()
        );
    }


}
