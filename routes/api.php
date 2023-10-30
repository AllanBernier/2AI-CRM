<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcontractorController;
use App\Http\Controllers\TjmTypeController;
use App\Http\Controllers\TrainingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/company', [CompanyController::class, 'index'])->name('companies.index');

Route::get('/customer', [CustomerController::class, 'all'])->name('customers.all');
Route::post('/customer', [CustomerController::class, 'store'])->name('customers.store');
Route::put('/customer/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

Route::get('/product', [ProductController::class, 'all'])->name('products.all');
Route::post('/product', [ProductController::class, 'store'])->name('products.store');
Route::post('/product/search', [ProductController::class, 'search'])->name('products.search');
Route::put('/product/{product}', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/subcontractor', [SubcontractorController::class, 'all'])->name('subcontractors.all');
Route::post('/subcontractor', [SubcontractorController::class, 'store'])->name('subcontractors.store');
Route::put('/subcontractor/{subcontractor}', [SubcontractorController::class, 'edit'])->name('subcontractors.edit');
Route::delete('/subcontractor/{subcontractor}', [SubcontractorController::class, 'destroy'])->name('subcontractors.destroy');

Route::put('/tjm/edit/{subcontractor}/{tjm_type}', [TjmTypeController::class, 'edit'])->name('tjms.edit');

Route::get('/training', [TrainingController::class, 'all'])->name('trainings.all');
Route::post('/training', [TrainingController::class, 'store'])->name('trainings.store');
Route::put('/training/{training}', [TrainingController::class, 'edit'])->name('trainings.edit');

Route::middleware('auth')->group(function () {

});
