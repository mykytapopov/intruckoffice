<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DispatcherController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/dispatchers', DispatcherController::class)->except(['show']);
    Route::resource('/loads', LoadController::class)->except('show');
    Route::post('/loads/{load}/status', [LoadController::class, 'quickStatusChange'])->name('load.quick-status-change');
    Route::resource('/drivers', DriverController::class);
    Route::resource('/works', WorkController::class)->except(['index', 'show']);
    Route::resource('/invoices', InvoiceController::class)->except(['create']);
    Route::get('/drivers/{driver}/invoices/create', [InvoiceController::class, 'create'])
        ->name('drivers.invoices.create');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/migrate', [MigrationController::class, 'migrate'])->name('db.migrate');
});

require __DIR__ . '/auth.php';
