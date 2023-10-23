<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
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

Route::post('/customer', [CustomerController::class, 'store'])->name('customers.store');
Route::put('/customer/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

Route::middleware('auth')->group(function () {

});
