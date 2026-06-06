<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Rute ini sekarang diarahkan langsung ke ProductController
// sehingga data produk akan dikirim ke halaman utama ('/')
Route::get('/', [ProductController::class, 'index']);

// Rute ini tetap ada jika Anda ingin mengaksesnya secara khusus
Route::get('/products', [ProductController::class, 'index']);