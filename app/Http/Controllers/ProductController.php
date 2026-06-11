<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua data produk dari database
        $products = Product::all();
        
        // Ubah 'products.index' menjadi 'welcome'
        return view('welcome', compact('products'));
    }

    public function updateStok(Request $request)
    {
        // Validasi input untuk memastikan id dan qty ada
        $request->validate([
            'id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        // Mencari produk berdasarkan ID
        $product = Product::find($request->id);

        // Memastikan produk ditemukan dan stok mencukupi sebelum dikurangi
        if ($product && $product->stok >= $request->qty) {
            $product->decrement('stok', $request->qty);
            
            return response()->json(['success' => true, 'message' => 'Stok berhasil diperbarui']);
        }

        return response()->json(['success' => false, 'message' => 'Stok tidak mencukupi atau produk tidak ditemukan'], 400);
    }
}