<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminKasirController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;




// Route untuk halaman login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk kasir (dengan middleware session check)
Route::middleware(['kasir'])->group(function () {
    Route::get('/kasir/index', [KasirController::class, 'index'])->name('kasir.index');
    Route::get('/kasir/search', [KasirController::class, 'search'])->name('kasir.search');
    Route::post('/kasir/transaksi', [KasirController::class, 'proses_transaksi'])->name('kasir.transaksi');
    Route::get('/kasir/download-invoice/{invoice_number}', [KasirController::class, 'download_invoice'])
        ->name('kasir.download_invoice');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/admin/produk', [AdminController::class, 'produk_index'])->name('admin.produk.index');
    Route::get('/admin/produk/create', [AdminController::class, 'produkcreate'])->name('admin.produk.create');
    Route::post('/admin/produk/store', [AdminController::class, 'produkstore'])->name('admin.produk.store');
    Route::get('/admin/produk/show/{id}', [AdminController::class, 'produkshow'])->name('admin.produk.show');
    Route::get('/admin/produk/edit/{id}', [AdminController::class, 'produkedit'])->name('admin.produk.edit');
    Route::put('/admin/produk/update/{id}', [AdminController::class, 'produkupdate'])->name('admin.produk.update');
    Route::post('/admin/produk/delete/{id}', [AdminController::class, 'produkdelete'])->name('admin.produk.destroy');
    Route::get('/admin/produk/search', [AdminController::class, 'produk_search'])->name('admin.produk.search');
    // Route untuk kelola transaksi
    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('/admin/transaksi/{id}', [TransaksiController::class, 'show'])->name('admin.transaksi.show');
    Route::post('/admin/transaksi/{id}/delete', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');

    //Route Kelola Kasir
    Route::get('/kasir', [AdminKasirController::class, 'index'])->name('admin.kasir.index');
    Route::get('/kasir/create', [AdminKasirController::class, 'create'])->name('admin.kasir.create');
    Route::post('/kasir/store', [AdminKasirController::class, 'store'])->name('admin.kasir.store');
    Route::get('/kasir/{id}/show', [AdminKasirController::class, 'show'])->name('admin.kasir.show');
    Route::get('/kasir/{id}/edit', [AdminKasirController::class, 'edit'])->name('admin.kasir.edit');
    Route::put('/kasir/{id}/update', [AdminKasirController::class, 'update'])->name('admin.kasir.update');
    Route::delete('/kasir/{id}/delete', [AdminKasirController::class, 'destroy'])->name('admin.kasir.destroy');
});
