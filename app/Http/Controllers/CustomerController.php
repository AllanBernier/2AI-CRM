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
    public function index(Request $request)
    {
        return Inertia::render('Customer/Index', [
            'customers' => Customer::with('company')
                ->when($request->input('search'), function ($query, $search) {
                    $query->tokenizedSearch($search, [
                        'first_name',
                        'last_name',
                        'role',
                        'phone',
                        'email',
                        'city',
                    ]);
                })
                ->orderBy('company_id')
                ->get(),
            'filters' => $request->only(['search']),
            'companies' => Company::all()
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

    public function destroy(Customer $customer)
    {
        $customer->delete();
    }
}
