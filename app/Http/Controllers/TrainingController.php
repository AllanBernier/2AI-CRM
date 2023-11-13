<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingStoreRequest;
use App\Mail\ARNouveau;
use App\Models\Company;
use App\Models\Cursus;
use App\Models\Product;
use App\Models\Subcontractor;
use App\Models\TjmType;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class TrainingController extends Controller
{


    public function all()
    {
        return new JsonResource(
            Training::
            with('product', 'customer', 'customer.company', 'subcontractor', 'subcontractor.leader')
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
        $training_data = $request->validated();
        $training = null;

        if (isset($training_data['cursus_id'])){
            $cursus = Cursus::find($training_data['cursus_id']);

            if (!isset($cursus->product_id) || !isset($cursus->customer_id)){
                abort(403);
            } else {
                $training_data['customer_id'] = $cursus->customer_id;
                $training_data['product_id'] = $cursus->product_id;
            }

        }

        $training = Training::create($training_data);
        $training->refresh();
        $training->load('product', 'customer', 'customer.company', 'subcontractor', 'subcontractor.leader');
        return new JsonResource($training);
    }

    public function edit(Training $training, TrainingStoreRequest $request)
    {
        $training->update($request->validated());
        $training->load('product', 'customer', 'customer.company', 'subcontractor', 'subcontractor.leader');

        return new  JsonResource($training);
    }

    public function destroy(Training $training)
    {
        $training->delete();
        return new JsonResource($training);
    }

    public function mail(Training $training, Request $request)
    {
        $training->load('customer');



        if (isset($request['action_customer']) && isset($training->customer->email)){
            switch ($request['action_customer']) {
                case "AR Nouveau":
                    Mail::to($training->customer->email)->queue(new ARNouveau($training));
                    $training->update(['action_customer' => "AR Nouveau"]);
                    break;
            }
            $training->update(['action_customer' => $request['action_customer']]);
        }
        if (isset($request['action_subcontractor']) ) {
            $training->update(['action_subcontractor' => $request['action_subcontractor']]);
        }


        return new JsonResource(['message' => 'Email sent']);
    }
}
