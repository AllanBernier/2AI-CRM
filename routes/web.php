<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CursusController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcontractorController;
use App\Http\Controllers\Subcontractors\SubcontractorTrainingController;
use App\Http\Controllers\Subcontractors\SubcontractorViewController;
use App\Http\Controllers\TjmTypeController;
use App\Http\Controllers\TrainingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');











Route::middleware('auth')->group(function () {
    Route::get('/company', [CompanyController::class, 'index'])->name('companies.index');

    Route::post('/cursus', [CursusController::class, 'store'])->name('cursuses.store');
    Route::put('/cursus/{cursus}', [CursusController::class, 'edit'])->name('cursuses.edit');


    Route::get('/customer/all', [CustomerController::class, 'all'])->name('customers.all');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customer/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::get('/product/all', [ProductController::class, 'all'])->name('products.all');
    Route::post('/product', [ProductController::class, 'store'])->name('products.store');
    Route::post('/product/search', [ProductController::class, 'search'])->name('products.search');
    Route::put('/product/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/subcontractor/all', [SubcontractorController::class, 'all'])->name('subcontractors.all');
    Route::post('/subcontractor', [SubcontractorController::class, 'store'])->name('subcontractors.store');
    Route::put('/subcontractor/{subcontractor}', [SubcontractorController::class, 'edit'])->name('subcontractors.edit');
    Route::delete('/subcontractor/{subcontractor}', [SubcontractorController::class, 'destroy'])->name('subcontractors.destroy');
    Route::put('/tjm/edit/{subcontractor}/{tjm_type}', [TjmTypeController::class, 'edit'])->name('tjms.edit');
    Route::get('/training/all', [TrainingController::class, 'all'])->name('trainings.all');
    Route::post('/training', [TrainingController::class, 'store'])->name('trainings.store');
    Route::delete('/training/{training}', [TrainingController::class, 'destroy'])->name('trainings.destroy');
    Route::put('/training/{training}', [TrainingController::class, 'edit'])->name('trainings.edit');


    Route::get('/sub/trainings', [SubcontractorTrainingController::class, 'index'])->name('subcontractors.trainings.index');
    Route::get('/sub/trainings/toconfirm', [SubcontractorTrainingController::class, 'toconfirm'])->name('subcontractors.trainings.toconfirm');
    Route::get('/sub/trainings/option', [SubcontractorTrainingController::class, 'options'])->name('subcontractors.trainings.options');
    Route::get('/sub/trainings/new', [SubcontractorTrainingController::class, 'new'])->name('subcontractors.trainings.new');
    Route::post('/sub/trainings/month', [SubcontractorTrainingController::class, 'month'])->name('subcontractors.trainings.month');
    Route::get('/sub/trainings/incoming', [SubcontractorTrainingController::class, 'incoming'])->name('subcontractors.trainings.incoming');
});



Route::middleware('auth')->group(function () {
    Route::get('/cursus', [CursusController::class, 'index'])->name('cursuses.index');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/product', [ProductController::class, 'index'])->name('products.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/subcontractor/{subcontractor}', [SubcontractorController::class, 'show'])->name('subcontractors.show');
    Route::get('/subcontractor', [SubcontractorController::class, 'index'])->name('subcontractors.index');
    Route::get('/training', [TrainingController::class, 'index'])->name('trainings.index');
    Route::get('/profile/dashboard', [SubcontractorViewController::class, 'index'])->name('subcontractorsview.index');
});

require __DIR__.'/auth.php';
