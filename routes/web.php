<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;

// Route untuk halaman login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk kasir (dengan middleware session check)
Route::middleware(['kasir'])->group(function () {
    Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::get('/kasir/search', [KasirController::class, 'search'])->name('kasir.search');
    Route::post('/kasir/transaksi', [KasirController::class, 'proses_transaksi'])->name('kasir.transaksi');
});
