<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Company;
use App\Models\Product;
use App\Models\TjmType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Inertia;

class ProductController extends Controller
{


    public function all()
    {
        return new JsonResource(Product::with('company')->get());
    }
    public function index(Request $request)
    {
        return Inertia::render('Product/Index', [
            'products' => Product::with('company', 'tjm_type')
                ->when($request->input('search'), function ($query, $search) {
                    $query->tokenizedSearch($search, [
                        'code', 'url', 'description', 'tjm', 'duree'
                    ]);
                })
                ->orderBy('company_id')
                ->get(),
            'filters' => $request->only(['search']),
            'companies' => Company::all(),
            'tjm_types' => TjmType::all(),
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

    public function search(Request $request)
    {
        return Product::with('company', 'tjm_type')
            ->when($request->input('search'), function ($query, $search) {
                $query->tokenizedSearch($search, [
                    'code', 'url', 'description', 'tjm', 'duree'
                ]);
            })
            ->paginate(10);
    }
}
