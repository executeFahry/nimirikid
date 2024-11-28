<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\PaketController;
use App\Http\Controllers\Api\KurirController;
use App\Http\Controllers\Api\StatusPengirimanController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('api')->group(function () {
    Route::apiResource('pelanggan', PelangganController::class, ['as' => 'api']);
    Route::apiResource('paket', PaketController::class, ['as' => 'api']);
    Route::apiResource('kurir', KurirController::class, ['as' => 'api']);
    Route::apiResource('status-pengiriman', StatusPengirimanController::class, ['as' => 'api']);

    // melihat paket yang dikirim oleh pelanggan tertentu
    Route::get('pelanggan/{id}/paket-dikirim', [PelangganController::class, 'paketDikirim'])->name('api.pelanggan.paket-dikirim');

    // melihat semua paket yang ditangani oleh kurir tertentu
    Route::get('kurir/{id}/paket', [KurirController::class, 'paket'])->name('api.kurir.paket');

    // ubah status pengiriman paket berdasarkan id paket secara otomatis
    Route::post('paket/{id}/ubah-status', [PaketController::class, 'ubahStatus'])->name('api.paket.ubah-status');

    // menambahkan status saat paket diambil oleh kurir
    Route::post('paket/{id}/diambil', [PaketController::class, 'paketDiambil'])->name('api.paket.diambil');

    // menambahkan status saat pakel gagal dikirim oleh kurir
    Route::post('paket/{id}/gagal', [PaketController::class, 'paketGagal'])->name('api.paket.gagal');
});
