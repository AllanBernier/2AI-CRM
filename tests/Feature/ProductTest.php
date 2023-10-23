<?php

use App\Models\Company;
use App\Models\Product;
use App\Models\TjmType;
use function Pest\Laravel\delete;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

test('i can create products', function () {
    $product_data = Product::factory()->make()->toArray();
    $product_data['company_id'] = Company::factory()->create()->id;

    $response = post(route('products.store'), $product_data );

    $product = Product::first();
    expect($response->status())->toBe(201)
        ->and(Product::count())->toBe(1)
        ->and($product_data['code'])->toBe($product->code)
        ->and($product_data['description'])->toBe($product->description)
        ->and($product_data['url'])->toBe($product->url)
        ->and($product_data['tjm'])->toBe($product->tjm)
        ->and($product_data['duree'])->toBe($product->duree)
        ->and($product_data['company_id'])->toBe($product->company_id);
});

test('i can edit products', function () {
    $product_data = Product::factory()->create()->toArray();
    $product_data['description'] = "Description du produit";

    $response = put(route('products.edit', ['product' => $product_data['id']]), $product_data );

    $product = Product::first();
    expect($response->status())->toBe(200)
        ->and(Product::count())->toBe(1)
        ->and($product->description)->toBe($product_data['description']);
});

test('i can delete products', function () {
    Product::factory(5)->create();
    $to_delete = Product::factory()->create();

    $response = delete(route('products.destroy', ['product' => $to_delete->id]));

    expect($response->status())->toBe(200)
        ->and(Product::count())->toBe(5);
});

test('Product can be linked to company', function () {
    $m2i = Company::factory()->create(['name' => 'm2i']);
    $products = Product::factory(5)->create(['company_id' => $m2i->id]);

    expect($m2i->products->count())->toBe(5)
        ->and($products[0]->company->name)->toBe('m2i');
});


test('i can edit tjm_type on product', function () {
    $tjm_poe = TjmType::factory()->create(['name'=> 'TJM POE']);
    $poe_java = Product::factory()->create();
    $poe_java_data = $poe_java->toArray();
    $poe_java_data['tjm_type_id'] = $tjm_poe->id;

    $response = put(route('products.edit', ['product' => $poe_java_data['id']]), $poe_java_data );

    expect($response->status())->toBe(200)
        ->and(Product::first()->tjm_type->name)->toBe('TJM POE');
});


test('i can search paginated products with tokenized search', function () {
    Product::factory(5)->create();
    Product::factory(6)->create(['code' => 'tttt']);
    Product::factory(6)->create(['description' => 'tttt']);

    $response = post(route('products.search'), ['search' => 'tttt']);


    expect($response->status())->toBe(200)
        ->and(count($response->json('data')))->toBe(10)
        ->and($response->json('total'))->toBe(12);

})->only();
