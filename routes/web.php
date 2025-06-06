<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\AduanUserController;
use App\Http\Controllers\Admin\AduanAdminController;
use App\Http\Controllers\Admin\KelolaPelaporController;
use App\Http\Controllers\User\UserHomeController;



// Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Redirect ke dashboard sesuai role
Route::middleware(['auth'])->get('/dashboard', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.pengaduan.index')
        : redirect()->route('user.pengaduan.index');
})->name('dashboard');

// ================= USER / MASYARAKAT =================
Route::middleware(['auth', 'verified'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/home', [UserHomeController::class, 'index'])->name('home');

        // Pengaduan: hanya bisa melihat list, detail, membuat
        Route::get('pengaduan', [AduanUserController::class, 'index'])->name('pengaduan.index');
        Route::get('pengaduan/create', [AduanUserController::class, 'create'])->name('pengaduan.create');
        Route::post('pengaduan', [AduanUserController::class, 'store'])->name('pengaduan.store');
        Route::get('pengaduan/{pengaduan}', [AduanUserController::class, 'show'])->name('pengaduan.show');
    });



// ================= ADMIN =================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('kelolapelapor', KelolaPelaporController::class);

        // Pengaduan routes for admin (pakai AduanAdminController)
        Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
            Route::get('/', [AduanAdminController::class, 'index'])->name('index');
            Route::get('/{id}', [AduanAdminController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [AduanAdminController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AduanAdminController::class, 'update'])->name('update');
            Route::delete('/{id}', [AduanAdminController::class, 'destroy'])->name('destroy');
            
        });
    });

require __DIR__.'/auth.php';
