<?php

use App\Http\Controllers\CursusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SubcontractorController;
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
    Route::get('/cursus', [CursusController::class, 'index'])->name('cursuses.index');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/product', [ProductController::class, 'index'])->name('products.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/subcontractor/{subcontractor}', [SubcontractorController::class, 'show'])->name('subcontractors.show');
    Route::get('/subcontractor', [SubcontractorController::class, 'index'])->name('subcontractors.index');

    Route::get('/training', [TrainingController::class, 'index'])->name('trainings.index');

});

require __DIR__.'/auth.php';
