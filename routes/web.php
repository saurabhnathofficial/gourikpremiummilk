<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\FarmerController;
use App\Http\Controllers\Admin\MilkEntryController;
use App\Http\Controllers\Farmer\DashboardController as FarmerDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FarmerBillController;
/*
|--------------------------------------------------------------------------
| Public Website
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| Authenticated Area
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    Route::get('/farmer/dashboard', [FarmerDashboardController::class, 'index'])
        ->name('farmer.dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Farmer Management

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/farmers', [FarmerController::class, 'index'])
        ->name('admin.farmers.index');

    Route::get('/farmers/create', [FarmerController::class, 'create'])
        ->name('admin.farmers.create');

    Route::post('/farmers', [FarmerController::class, 'store'])
        ->name('admin.farmers.store');


    Route::get('/farmers/{farmer}/edit', [FarmerController::class, 'edit'])
        ->name('admin.farmers.edit');

    Route::put('/farmers/{farmer}', [FarmerController::class, 'update'])
        ->name('admin.farmers.update');

    Route::get('/farmer-bills', [FarmerBillController::class, 'index'])
        ->name('admin.farmer-bills.index');

    // Milk History
    Route::get('/milk', [MilkEntryController::class, 'index'])
        ->name('admin.milk.index');

    // Milk edit/update
    Route::get('/milk/{milkEntry}/edit', [MilkEntryController::class, 'edit'])
        ->name('admin.milk.edit');

    Route::put('/milk/{milkEntry}', [MilkEntryController::class, 'update'])
        ->name('admin.milk.update');

    // Morning/evening milk entry
    Route::get('/milk/{session?}', [MilkEntryController::class, 'create'])
        ->where('session', 'morning|evening|both')
        ->name('admin.milk.create');

    Route::post('/milk', [MilkEntryController::class, 'store'])
        ->name('admin.milk.store');
});


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
