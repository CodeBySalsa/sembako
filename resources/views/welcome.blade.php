<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SembakoKita | Belanja Dapur Hemat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen" 
    @extends('layouts.app')

@section('content')
<div x-data="{ 
    cartOpen: false, checkoutOpen: false, detailOpen: false,
    selectedWeight: 5, weights: [5, 10, 25, 50],
    checkoutItem: null, detailItem: null,
    nama: '', alamat: '', no_hp: '', 
    cart: [], notify: false,
    selectedCategory: null, sortBy: 'default',
    rawProducts: [],
    categories: [
        { nama: 'Beras', file: 'beras.jpg', color: 'bg-orange-100' },
        { nama: 'Bumbu Masakan', file: 'bumbu.jpg', color: 'bg-yellow-100' },
        { nama: 'Detergent', file: 'detergent.jpg', color: 'bg-blue-100' },
        { nama: 'Gula Pasir', file: 'gula.jpg', color: 'bg-pink-100' },
        { nama: 'Ikan Kaleng', file: 'ikan.jpg', color: 'bg-red-100' },
        { nama: 'Kecap', file: 'kecap.jpg', color: 'bg-amber-100' },
        { nama: 'Kopi Saset', file: 'kopi.jpg', color: 'bg-stone-200' },
        { nama: 'Makanan Ringan', file: 'snack.jpg', color: 'bg-purple-100' },
        { nama: 'Mie Instant', file: 'mie.jpg', color: 'bg-emerald-100' },
        { nama: 'Minuman', file: 'minuman.jpg', color: 'bg-cyan-100' },
        { nama: 'Minyak Goreng', file: 'minyak.jpg', color: 'bg-yellow-200' },
        { nama: 'Pasta Gigi', file: 'pasta.jpg', color: 'bg-slate-100' }
    ],
    addToCart(product) {
        if(product.stok <= 0) return;
        let exist = this.cart.find(item => item.nama === product.nama);
        if(exist) { exist.qty++; } 
        else { this.cart.push({...product, qty: 1}); }
        this.notify = true;
        setTimeout(() => this.notify = false, 2000);
    },
    openDetail(product) { this.detailItem = product; this.selectedWeight = 5; this.detailOpen = true; },
    openCheckout(product) { this.checkoutItem = product; this.checkoutOpen = true; },
    get filteredProducts() {
        let list = this.rawProducts.map(p => ({
            id: p.id, nama: p.nama_produk, harga: parseInt(p.harga),
            kategori: p.kategori, gambar: p.gambar, stok: parseInt(p.stok || 0),
            deskripsi: p.deskripsi || 'Belum ada deskripsi untuk produk ini.'
        }));
        if (this.sortBy === 'low') list.sort((a, b) => a.harga - b.harga);
        if (this.sortBy === 'high') list.sort((a, b) => b.harga - a.harga);
        return list;
    }
}" x-init="rawProducts = {{ json_encode($products) }}">

    <div x-show="notify" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="bg-white px-8 py-4 rounded-2xl shadow-2xl border-2 border-green-500 flex items-center gap-3">
            <span class="text-2xl">✅</span>
            <span class="font-bold text-gray-800">Berhasil ditambahkan!</span>
        </div>
    </div>

    <div x-show="cartOpen" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-2xl rounded-3xl p-8 shadow-2xl" @click.away="cartOpen = false">
            <h2 class="text-2xl font-black mb-6">Keranjang Belanja</h2>
            <div class="max-h-[60vh] overflow-y-auto mb-6 pr-2 space-y-4">
                <template x-for="(item, index) in cart" :key="item.nama">
                    <div class="flex items-center gap-4 border-b pb-4">
                        <img :src="'{{ asset('images/') }}/' + item.gambar" class="w-20 h-20 object-cover rounded-xl border">
                        <div class="flex-1">
                            <h3 class="font-bold text-lg" x-text="item.nama"></h3>
                            <p class="text-green-600 font-semibold">Rp <span x-text="(item.harga * item.qty).toLocaleString()"></span></p>
                        </div>
                        <div class="flex items-center gap-3 bg-gray-50 p-2 rounded-lg">
                            <button @click="item.qty > 1 ? item.qty-- : cart.splice(index, 1)" class="bg-white px-3 py-1 rounded-md shadow-sm font-bold">-</button>
                            <span class="font-bold w-8 text-center" x-text="item.qty"></span>
                            <button @click="item.qty++" class="bg-white px-3 py-1 rounded-md shadow-sm font-bold">+</button>
                        </div>
                    </div>
                </template>
                <p x-show="cart.length === 0" class="text-gray-400 text-center py-10 italic">Keranjang masih kosong.</p>
            </div>
            <div x-show="cart.length > 0" class="border-t pt-6 mb-6">
                <div class="flex justify-between items-center text-xl">
                    <span class="font-bold text-gray-600">Total Harga:</span>
                    <span class="font-black text-green-700">Rp <span x-text="cart.reduce((total, item) => total + (item.harga * item.qty), 0).toLocaleString()"></span></span>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <button @click="cartOpen = false" class="flex-1 bg-gray-100 py-4 rounded-2xl font-bold">Lanjut Belanja</button>
                <button @click="if(cart.length > 0) { checkoutItem = {nama: cart.map(i => i.nama + ' ('+i.qty+'x)').join(', ')}; checkoutOpen = true; cartOpen = false; } else { alert('Keranjang kosong!'); }" 
                        class="flex-1 bg-green-600 text-white py-4 rounded-2xl font-bold shadow-lg">Pesan via WhatsApp</button>
            </div>
        </div>
    </div>

    <header class="bg-gradient-to-r from-green-600 to-emerald-500 text-white py-12 shadow-lg">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-black mb-2">Penuhi Kebutuhan Dapur Tanpa Ribet</h2>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="relative flex flex-col items-center justify-center mb-6">
            <h2 class="text-2xl font-black text-gray-800" x-text="selectedCategory ? selectedCategory : 'Kategori'"></h2>
            <div x-show="selectedCategory" class="md:absolute md:right-0 mt-2 md:mt-0">
                <select x-model="sortBy" class="bg-white border-2 border-green-200 px-4 py-2 rounded-xl font-bold text-green-700">
                    <option value="default">Urutkan Harga</option>
                    <option value="low">Termurah</option>
                    <option value="high">Termahal</option>
                </select>
            </div>
        </div>

        <div x-show="!selectedCategory" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <template x-for="cat in categories" :key="cat.nama">
                <button @click="selectedCategory = cat.nama" :class="cat.color" class="p-4 rounded-3xl border-2 border-white shadow-sm flex flex-col items-center justify-center gap-3 hover:scale-105 transition aspect-square">
                    <img :src="'{{ asset('images/categories') }}/' + cat.file" class="w-20 h-20 object-contain rounded-full bg-white/50 p-2">
                    <span class="font-bold text-gray-800" x-text="cat.nama"></span>
                </button>
            </template>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" x-show="selectedCategory">
            <template x-for="product in filteredProducts.filter(p => p.kategori === selectedCategory)" :key="product.id">
                <div class="bg-green-50 rounded-2xl p-3 shadow-sm border border-green-100 flex flex-col cursor-pointer" @click="openDetail(product)">
                    <img :src="'{{ asset('images/') }}/' + product.gambar" class="w-full aspect-square object-cover rounded-xl mb-3">
                    <h2 class="text-sm font-bold text-gray-800 truncate" x-text="product.nama"></h2>
                    <p class="text-green-700 font-black text-sm mb-3">Rp <span x-text="product.harga.toLocaleString()"></span></p>
                    <button @click.stop="openCheckout(product)" class="w-full bg-orange-500 text-white py-2 rounded-lg text-xs font-bold hover:bg-orange-600 transition">
                        Beli Sekarang
                    </button>
                </div>
            </template>
        </div>
    </div>

    <div x-show="detailOpen" x-cloak class="fixed inset-0 z-[200] bg-emerald-50 overflow-y-auto">
        <div class="container mx-auto px-4 py-12 max-w-5xl">
            <div class="grid md:grid-cols-2 gap-12 items-start bg-gradient-to-br from-emerald-50 to-white p-8 rounded-[2rem] shadow-xl border border-emerald-100">
                <div class="sticky top-8">
                    <img :src="'{{ asset('images/') }}/' + detailItem?.gambar" class="w-full aspect-square object-cover rounded-3xl shadow-inner border-4 border-white ring-2 ring-emerald-100">
                </div>
                <div>
                    <h2 class="text-4xl font-black text-gray-800 mb-2" x-text="detailItem?.nama"></h2>
                    <div class="text-3xl font-black text-emerald-600 mb-6 flex items-center gap-2">
                        <span class="text-lg text-gray-400">Harga:</span>
                        Rp <span x-text="(detailItem?.harga * (selectedWeight / 5)).toLocaleString()"></span>
                    </div>
                    <div class="mb-8">
                        <p class="text-sm font-bold text-gray-500 mb-4 uppercase tracking-widest">Pilih Berat (kg):</p>
                        <div class="grid grid-cols-4 gap-3">
                            <template x-for="w in weights" :key="w">
                                <button @click="selectedWeight = w" 
                                        :class="selectedWeight === w ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-white text-gray-600 hover:bg-emerald-50 border border-emerald-100'"
                                        class="py-4 rounded-2xl font-bold transition duration-300" x-text="w + ' kg'"></button>
                            </template>
                        </div>
                    </div>
                    <div class="bg-white/50 p-6 rounded-2xl mb-8 border border-emerald-100">
                        <h4 class="font-bold text-emerald-900 mb-4 flex items-center gap-2">
                            <span>📝</span> Lengkapi Data Pemesanan
                        </h4>
                        <input x-model="nama" placeholder="Nama Lengkap" class="w-full bg-white border-2 border-emerald-100 p-4 rounded-xl mb-3 focus:ring-2 focus:ring-emerald-400 outline-none transition">
                        <input x-model="alamat" placeholder="Alamat Lengkap" class="w-full bg-white border-2 border-emerald-100 p-4 rounded-xl mb-3 focus:ring-2 focus:ring-emerald-400 outline-none transition">
                        <input x-model="no_hp" placeholder="Nomor WhatsApp" class="w-full bg-white border-2 border-emerald-100 p-4 rounded-xl focus:ring-2 focus:ring-emerald-400 outline-none transition">
                    </div>
                    <div class="flex flex-col gap-4">
                        
                        <button @click="if(nama && alamat && no_hp) { 
                            let msg = `Halo, saya ingin membeli ${detailItem.nama} (${selectedWeight}kg).%0ANama: ${nama}%0AAlamat: ${alamat}%0ANo HP: ${no_hp}`; 
                            window.open('https://wa.me/6281234567890?text=' + msg, '_blank'); 
                            detailOpen = false;
                        } else { alert('Mohon lengkapi Nama, Alamat, dan Nomor WhatsApp!'); }" 
                                :disabled="!(nama && alamat && no_hp)"
                                :class="(nama && alamat && no_hp) ? 'bg-emerald-600 hover:bg-emerald-700 shadow-xl shadow-emerald-200' : 'bg-gray-300 cursor-not-allowed'"
                                class="w-full text-white py-4 rounded-2xl font-bold text-lg transition duration-300">
                            Pesan via WhatsApp
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div x-show="checkoutOpen" x-cloak class="fixed inset-0 z-[210] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-3xl w-full max-w-sm shadow-2xl">
            <h2 class="text-xl font-black mb-4">Lengkapi Biodata</h2>
            <input x-model="nama" placeholder="Nama Lengkap" class="w-full border-2 border-green-100 p-3 rounded-xl mb-3">
            <input x-model="alamat" placeholder="Alamat Lengkap" class="w-full border-2 border-green-100 p-3 rounded-xl mb-3">
            <input x-model="no_hp" placeholder="Nomor WhatsApp" class="w-full border-2 border-green-100 p-3 rounded-xl mb-4">
            <button @click="if(nama && alamat && no_hp) { 
                let msg = `Halo, saya ingin membeli ${detailItem.nama} (${selectedWeight}kg).%0ANama: ${nama}%0AAlamat: ${alamat}%0ANo HP: ${no_hp}`; 
                window.open('https://wa.me/6281234567890?text=' + msg, '_blank'); 
                detailOpen = false;
            }" 
            :disabled="!(nama && alamat && no_hp)"
            :class="(nama && alamat && no_hp) ? 'bg-green-600 hover:bg-green-700 shadow-lg' : 'bg-gray-300 cursor-not-allowed'"
            class="w-full text-white py-4 rounded-2xl font-bold text-lg transition duration-200">
                Pesan via WhatsApp
            </button>
            <button @click="checkoutOpen = false" class="w-full mt-2 text-gray-400 font-bold">Batal</button>
        </div>
    </div>
</div>
@endsection
</body>
</html>