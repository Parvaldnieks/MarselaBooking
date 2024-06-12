<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApartmentController;
use App\Http\Middleware\RegularUserMiddleware;
use Illuminate\Support\Facades\Route;

// Redirect to login page by default
Route::redirect('/', '/login');

Route::middleware(['auth', 'verified'])->group(function () {
    // Profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Regular User Dashboard
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

    // Apartment routes
    Route::middleware(RegularUserMiddleware::class)->group(function () {
        Route::get('/apartments/create', [ApartmentController::class, 'create'])->name('apartments.create');
        Route::post('/apartments/store', [ApartmentController::class, 'store'])->name('apartments.store');
        Route::get('/apartments/{apartment}/edit', [ApartmentController::class, 'edit'])->name('apartments.edit');
        Route::put('/apartments/{apartment}/update', [ApartmentController::class, 'update'])->name('apartments.update');
        Route::delete('/apartments/{apartment}/destroy', [ApartmentController::class, 'destroy'])->name('apartments.destroy');
    });

    // Other apartment routes
    Route::get('/apartments', [ApartmentController::class, 'index'])->name('apartments.index');
    Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartments.show');
});

require __DIR__.'/auth.php';