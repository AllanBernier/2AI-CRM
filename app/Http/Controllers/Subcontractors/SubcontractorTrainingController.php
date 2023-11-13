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

    public function new()
    {
        $sub_id = Auth::user()->subcontractor->id;

        return new JsonResource(
            Training::query()
                ->where('subcontractor_id', $sub_id)
                ->where('action_subcontractor', 'Solliciter')
                ->where(function($query) {
                    $query->where('status', 'option');
                    $query->orWhere('status', 'nouveau');
                })
                ->with('subcontractor')
                ->get()
        );
    }

    public function month(Request $request)
    {
        if (!isset($request['month'])){
            abort(403);
        }

        $date = Carbon::now()->month($request['month'])->day(1);
        $sub_id = Auth::user()->subcontractor->id;
        $query = Training::query();
        $query->where('subcontractor_id', $sub_id);
        $query->where('status','option');
        $query->whereDate('end_date', '>=', $date->format('Y-m-d'));
        $query->whereDate('end_date', '<', $date->addMonth(1)->format('Y-m-d'));
        $query->orderBy('start_date');
        $query->with('subcontractor');

        return new JsonResource(
            $query->get()
        );
    }

    public function toconfirm()
    {
        $sub_id = Auth::user()->subcontractor->id;
        $query = Training::query();
        $query->where('subcontractor_id', $sub_id);
        $query->where('status', 'confirmé');
        $query->where('action_subcontractor', 'Envoyer BDC');
        $query->orderBy('start_date');
        $query->with('subcontractor');

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
        $query->with('subcontractor');
        return new JsonResource(
            $query->get()
        );
    }

    public function arbdc(Training $training)
    {

        if ($training->action_subcontractor = "Envoyer BDC"){
            $training->action_subcontractor = "AR BDC";
            $training->save();
        }

        return new JsonResource($training);
    }

    public function confirm(Training $training, Request $request)
    {
        if (!isset($request['action'])){
            abort(403);
        }

        if ($training->action_subcontractor = "Solliciter"){
            if ($request['action'] == true){
                $training->action_subcontractor = "Accepte Solicitation";
            }

            if ($request['action'] == false){
                $training->action_subcontractor = "Refuse Solicitation";
            }
            $training->save();

        }

        return new JsonResource($training);
    }

}
