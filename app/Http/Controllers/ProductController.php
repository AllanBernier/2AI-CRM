<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('Product/Index', [
            'product' => Product::with('company')
                ->when($request->input('search'), function ($query, $search) {
                    $query->tokenizedSearch($search, [

                    ]);
                })
                ->get(),
            'filters' => $request->only(['search']),
            'companies' => Company::all()
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());
        return new JsonResource($product);
    }

    public function edit(Product $product, ProductStoreRequest $request)
    {
        $product->update($request->validated());
        return new JsonResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return new JsonResource($product);
    }
}
