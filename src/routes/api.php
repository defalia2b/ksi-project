<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\BarangApiController;

// API Routes baru buat UTS
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\KategoriApiController;
use App\Http\Controllers\Api\SupplierApiController;
use App\Http\Controllers\Api\TransaksiApiController;
use App\Http\Controllers\Api\DetailTransaksiApiController;
use App\Http\Controllers\Api\PenyesuaianStokApiController;

Route::middleware('client.auth')->group(function (){
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::post('/products', [ProductApiController::class, 'store']);

    // Resourceful routes baru yang perlu autentikasi (UTS)
    Route::apiResource('produk', ProdukApiController::class);
    Route::apiResource('transaksi', TransaksiApiController::class);
    Route::apiResource('detail-transaksi', DetailTransaksiApiController::class);
    Route::apiResource('penyesuaian-stok', PenyesuaianStokApiController::class);
});

// buat test kemarin
Route::get('/barang', [BarangApiController::class, 'index']);

// Resourceful routes baru setiap API controller buat UTS tanpa autentikasi
Route::apiResource('kategori', KategoriApiController::class);
Route::apiResource('supplier', SupplierApiController::class);