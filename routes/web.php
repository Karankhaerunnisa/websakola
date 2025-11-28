<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        // ->middleware(['auth', 'admin'])
        ->name('dashboard');

    Route::get('/registrants/export', [RegistrantController::class, 'export'])->name('registrants.export');
    Route::apiResource('/registrants', RegistrantController::class);
    Route::get('/registrants/{registrant}/print', [RegistrantController::class, 'print'])->name('registrants.print');
});

require __DIR__.'/auth.php';
