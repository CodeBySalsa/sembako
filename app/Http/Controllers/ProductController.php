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
}