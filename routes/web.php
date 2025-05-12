<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\AduanUserController;
use App\Http\Controllers\Admin\AduanAdminController;


// Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.pengaduan.index')
            : redirect()->route('user.pengaduan.index');
    })->name('dashboard');
});

// Masyarakat/User
Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pengaduan', AduanUserController::class);  // Routing untuk User
});

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Pengaduan Admin
    Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
        Route::get('/', [AduanAdminController::class, 'index'])->name('index');
        Route::get('/{id}', [AduanAdminController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AduanAdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AduanAdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [AduanAdminController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';