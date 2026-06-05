<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan.index');

    Route::post('/persediaan/masuk', [PersediaanController::class, 'storeMasuk'])->name('persediaan.masuk');
    Route::post('/persediaan/keluar', [PersediaanController::class, 'storeKeluar'])->name('persediaan.keluar');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/master/kategori', [KategoriController::class, 'index'])->name('master.kategori.index');
    Route::post('/master/kategori', [KategoriController::class, 'store'])->name('master.kategori.store');
    Route::put('/master/kategori/{id}', [KategoriController::class, 'update'])->name('master.kategori.update');
    Route::delete('/master/kategori/{id}', [KategoriController::class, 'destroy'])->name('master.kategori.destroy');

    Route::get('/master/barang', [BarangController::class, 'index'])->name('master.barang.index');
    Route::post('/master/barang', [BarangController::class, 'store'])->name('master.barang.store');
    Route::put('/master/barang/{id}', [BarangController::class, 'update'])->name('master.barang.update');
    Route::delete('/master/barang/{id}', [BarangController::class, 'destroy'])->name('master.barang.destroy');

    Route::get('/master/users', [UserController::class, 'index'])->name('master.user.index');
    Route::post('/master/users', [UserController::class, 'store'])->name('master.user.store');
    Route::put('/master/users/{id}', [UserController::class, 'update'])->name('master.user.update');
    Route::delete('/master/users/{id}', [UserController::class, 'destroy'])->name('master.user.destroy');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
