<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\StatusPengirimanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// Redirect root ke halaman login jika belum login
Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

// Rute untuk registrasi pengguna
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Rute untuk dashboard yang dinamis, admin, kurir, pelanggan
Route::middleware(['auth', 'verified'])->get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Rute untuk admin panel
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('kurir', KurirController::class);
    Route::resource('paket', PaketController::class);
    Route::resource('status-pengiriman', StatusPengirimanController::class)->except(['create', 'store']);
});

// Rute untuk kurir
Route::middleware(['auth', 'kurir'])->group(function () {
    Route::get('/paket-saya', [PaketController::class, 'indexKurir'])->name('paket.kurir');

    // Rute edit paket untuk kurir
    Route::get('/paket/{paket}/edit', [PaketController::class, 'edit'])->name('paket.edit');
    Route::put('/paket/{paket}', [PaketController::class, 'update'])->name('paket.update');
});

// Rute untuk pelanggan (hanya lihat status pengiriman)
Route::middleware(['auth', 'pelanggan'])->group(function () {
    Route::get('/status-pengiriman', [StatusPengirimanController::class, 'index'])->name('status-pengiriman.index');
});

// Rute untuk profil pengguna (dapat diakses oleh semua pengguna yang login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Impor rute otentikasi
require __DIR__ . '/auth.php';
