<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CursusController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GanttController;
use App\Http\Controllers\InvoiceCompanyController;
use App\Http\Controllers\InvoiceController;
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

});
Route::get('/company', [CompanyController::class, 'index'])->name('companies.index');

Route::post('/cursus', [CursusController::class, 'store'])->name('cursuses.store');
Route::put('/cursus/{cursus}', [CursusController::class, 'edit'])->name('cursuses.edit');


Route::get('/customer/all', [CustomerController::class, 'all'])->name('customers.all');
Route::post('/customer', [CustomerController::class, 'store'])->name('customers.store');
Route::put('/customer/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

Route::post('/gantt/planning', [GanttController::class, 'show'])->name('gantt.show');
Route::post('/gantt/search/{product}', [GanttController::class, 'search'])->name('gantt.search');

Route::get('/invoice/subcontractors/show/{training}', [InvoiceController::class, 'show'])->name('invoices.subcontractors.show');
Route::post('/invoice/subcontractors/store', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('/invoice/subcontractors/{month}/{year}', [InvoiceController::class, 'subcontractors'])->name('invoices.subcontractors');

Route::get('/invoice/company/bdc/{training}', [InvoiceCompanyController::class, 'showBdc'])->name('invoice.company.show.bdc');
Route::get('/invoice/company/billing/{company}', [InvoiceCompanyController::class, 'billing'])->name('invoices.company.billing');
Route::get('/invoice/company/paginated/{company}', [InvoiceCompanyController::class, 'paginated'])->name('invoice.company.paginated');
Route::get('/invoice/company/pdf/{invoice}', [InvoiceCompanyController::class, 'showInvoice'])->name('invoice.company.show.invoice');
Route::delete('/invoice/company/{invoice}', [InvoiceCompanyController::class, 'delete'])->name('invoice.company.destroy');



Route::post('/invoice/company/', [InvoiceCompanyController::class, 'store'])->name('invoice.company.store');



Route::get('/product/all', [ProductController::class, 'all'])->name('products.all');
Route::post('/product', [ProductController::class, 'store'])->name('products.store');
Route::post('/product/search', [ProductController::class, 'search'])->name('products.search');
Route::put('/product/{product}', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/subcontractor/all', [SubcontractorController::class, 'all'])->name('subcontractors.all');
Route::post('/subcontractor', [SubcontractorController::class, 'store'])->name('subcontractors.store');
Route::post('/subcontractor/attach/{product}/{subcontractor}', [SubcontractorController::class, 'attachProduct'])->name('subcontractor.product.attach');
Route::post('/subcontractor/detach/{product}/{subcontractor}', [SubcontractorController::class, 'detachProduct'])->name('subcontractor.product.detach');

Route::put('/subcontractor/{subcontractor}', [SubcontractorController::class, 'edit'])->name('subcontractors.edit');
Route::delete('/subcontractor/{subcontractor}', [SubcontractorController::class, 'destroy'])->name('subcontractors.destroy');

Route::put('/tjm/edit/{subcontractor}/{tjm_type}', [TjmTypeController::class, 'edit'])->name('tjms.edit');

Route::post('/training', [TrainingController::class, 'store'])->name('trainings.store');
Route::post('/training/bdc/{training}', [TrainingController::class, 'uploadBdc'])->name('trainings.bdc.upload');
Route::post('/training/mail/{training}', [TrainingController::class, 'mail'])->name('trainings.mail');
Route::get('/training/all', [TrainingController::class, 'all'])->name('trainings.all');
Route::delete('/training/{training}', [TrainingController::class, 'destroy'])->name('trainings.destroy');
Route::put('/training/{training}', [TrainingController::class, 'edit'])->name('trainings.edit');


Route::get('/sub/trainings', [SubcontractorTrainingController::class, 'index'])->name('subcontractors.trainings.index');
Route::post('/sub/trainings/arcbd/{training}', [SubcontractorTrainingController::class, 'arbdc'])->name('subcontractors.trainings.arbdc');
Route::post('/sub/trainings/confirm/{training}', [SubcontractorTrainingController::class, 'confirm'])->name('subcontractors.trainings.confirm');
Route::get('/sub/trainings/incoming', [SubcontractorTrainingController::class, 'incoming'])->name('subcontractors.trainings.incoming');
Route::post('/sub/trainings/month', [SubcontractorTrainingController::class, 'month'])->name('subcontractors.trainings.month');
Route::get('/sub/trainings/new', [SubcontractorTrainingController::class, 'new'])->name('subcontractors.trainings.new');
Route::get('/sub/trainings/option', [SubcontractorTrainingController::class, 'options'])->name('subcontractors.trainings.options');
Route::get('/sub/trainings/toconfirm', [SubcontractorTrainingController::class, 'toconfirm'])->name('subcontractors.trainings.toconfirm');



Route::middleware('auth')->group(function () {
    Route::get('/cursus', [CursusController::class, 'index'])->name('cursuses.index');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/planning', [GanttController::class, 'index'])->name('gantt.index');
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoicecompany', [InvoiceCompanyController::class, 'index'])->name('invoices.company.index');
    Route::get('/product', [ProductController::class, 'index'])->name('products.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/subcontractor/{subcontractor}', [SubcontractorController::class, 'show'])->name('subcontractors.show');
    Route::get('/subcontractor', [SubcontractorController::class, 'index'])->name('subcontractors.index');
    Route::get('/training', [TrainingController::class, 'index'])->name('trainings.index');
    Route::get('/profile/dashboard', [SubcontractorViewController::class, 'index'])->name('subcontractorsview.index');
    Route::get('/profile/facturation', [SubcontractorViewController::class, 'invoice'])->name('subcontractorsview.invoice');


});

require __DIR__.'/auth.php';
