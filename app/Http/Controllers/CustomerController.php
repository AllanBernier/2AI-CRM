<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerEditRequest;
use App\Http\Requests\CustomerStoreRequest;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Inertia::render('Customer/Index', [
            'companies' => Company::with('customers')->get()
        ]);
    }

    public function store(CustomerStoreRequest $request)
    {
        $customer = Customer::create($request->validated());
        return new JsonResource($customer);
    }

    public function edit(Customer $customer, CustomerEditRequest $request)
    {
        $customer->update( $request->validated());
        return new JsonResource( $customer );
    }
}
