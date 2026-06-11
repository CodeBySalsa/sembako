<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Rute ini sekarang diarahkan langsung ke ProductController
// sehingga data produk akan dikirim ke halaman utama ('/')
Route::get('/', [ProductController::class, 'index']);

// Rute ini tetap ada jika Anda ingin mengaksesnya secara khusus
Route::get('/products', [ProductController::class, 'index']);

// Rute untuk komunikasi frontend ke backend (update stok)
Route::post('/update-stok', [ProductController::class, 'updateStok']);

// =====================
// ROUTE ARTIKEL
// =====================

Route::view('/artikel/belanja-hemat', 'artikel.belanja-hemat');

Route::view('/artikel/menyimpan-beras', 'artikel.menyimpan-beras');

Route::view('/artikel/minyak-goreng', 'artikel.minyak-goreng');

Route::view('/artikel/mie-instan', 'artikel.mie-instan');

Route::view('/artikel/belanja-bulanan', 'artikel.belanja-bulanan');

Route::get('/info/hubungi-kami', function () {
    return view('info.hubungi-kami');
});

Route::get('/info/metode-pembayaran', function () {
    return view('info.metode-pembayaran');
});