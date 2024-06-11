<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('admin')->name('admin.dashboard');

    // Restricting access for regular users to create, edit, and delete apartments
    Route::middleware('regular_user')->group(function () {
        Route::get('/apartments/create', [ApartmentController::class, 'create'])->name('apartments.create');
        Route::post('/apartments', [ApartmentController::class, 'store'])->name('apartments.store');
        Route::get('/apartments/{apartment}/edit', [ApartmentController::class, 'edit'])->name('apartments.edit');
        Route::put('/apartments/{apartment}', [ApartmentController::class, 'update'])->name('apartments.update');
        Route::delete('/apartments/{apartment}', [ApartmentController::class, 'destroy'])->name('apartments.destroy');
    });

    Route::get('/apartments', [ApartmentController::class, 'index'])->name('apartments.index');
    Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartments.show');
});

require __DIR__.'/auth.php';