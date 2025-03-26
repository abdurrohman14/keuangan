<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Manajer\TransaksismanajerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Staf\TransaksisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KodeAkunController;
use App\Http\Controllers\Staf\AkunController;
use App\Http\Controllers\Manajer\KodeController;
use App\Http\Controllers\Admin\TransaksiController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // Kode Akun
    Route::prefix('admin-akun')->group(function () {
        Route::get('/', [AkunController::class, 'index'])->name('admin.akun');
    });
    // Transaksi
    Route::prefix('admin-transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('admin.transaksi');
        Route::get('/create', [TransaksiController::class, 'create'])->name('admin.transaksi.create');
        Route::post('/store', [TransaksiController::class, 'store'])->name('admin.transaksi.store');
        Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('admin.transaksi.edit');
        Route::put('/{id}/update', [TransaksiController::class, 'update'])->name('admin.transaksi.update');
        Route::delete('/{id}', [TransaksiController::class, 'delete'])->name('admin.transaksi.delete');
    });
});

// staf 
Route::middleware(['auth', 'role:stafkeuangan'])->group(function () {
    Route::get('/staf-keuangan', [DashboardController::class, 'staf'])->name('staf.dashboard');

    // Kode Akun
    Route::prefix('staf-kode-akun')->group(function() {
        Route::get('/', [KodeAkunController::class, 'index'])->name('index.kodeAkun');
        Route::post('/store', [KodeAkunController::class, 'store'])->name('kode.akun.store');
    });
    // Transaksi
    Route::prefix('staf-transaksi')->group(function () {
        Route::get('/', [TransaksisController::class, 'index'])->name('staf.transaksi');
        Route::get('/create', [TransaksisController::class, 'create'])->name('staf.transaksi.create');
        Route::post('/store', [TransaksisController::class, 'store'])->name('staf.transaksi.store');
        Route::get('/{id}/edit', [TransaksisController::class, 'edit'])->name('staf.transaksi.edit');
        Route::put('/{id}/update', [TransaksisController::class, 'update'])->name('staf.transaksi.update');
        Route::delete('/{id}', [TransaksisController::class, 'destroy'])->name('staf.transaksi.destroy');
    });
});

// manajer
Route::middleware(['auth', 'role:manajer'])->group(function () {
    Route::get('/manajer', [DashboardController::class, 'manajer'])->name('manajer.dashboard');

    Route::prefix('manajer-kode')->group(function () {
        Route::get('/', [kodeController::class, 'index'])->name('manajer.akun');
    });    
    Route::prefix('manajer-transaksi')->group(function () {
        Route::get('/', [TransaksismanajerController::class, 'index'])->name('manajer.transaksi');
    });    
});
