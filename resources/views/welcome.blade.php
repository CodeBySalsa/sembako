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

<body class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen" x-data="{ 
    cartOpen: false, 
    checkoutOpen: false,
    detailOpen: false,
    checkoutItem: null,
    detailItem: null,
    nama: '', alamat: '', no_hp: '', 
    cart: [], notify: false,
    selectedCategory: null,
    sortBy: 'default',
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
        let exist = this.cart.find(item => item.id === product.id);
        if(exist) { exist.qty++; } 
        else { this.cart.push({...product, qty: 1}); }
        this.notify = true;
        setTimeout(() => this.notify = false, 2000);
    },
    openCheckout(product) {
        this.checkoutItem = product;
        this.checkoutOpen = true;
    },
    openDetail(product) {
        this.detailItem = product;
        this.detailOpen = true;
    },
    get filteredProducts() {
        let products = [
            @foreach($products as $product)
            { 
                id: {{ $product->id }}, 
                nama: '{{ $product->nama_produk }}', 
                harga: {{ $product->harga }}, 
                kategori: '{{ $product->kategori }}', 
                gambar: '{{ $product->gambar }}', 
                stok: {{ $product->stok ?? 0 }}, 
                deskripsi: '{{ $product->deskripsi ?? 'Belum ada deskripsi untuk produk ini.' }}' 
            },
            @endforeach
        ];
        if (this.sortBy === 'low') products.sort((a, b) => a.harga - b.harga);
        if (this.sortBy === 'high') products.sort((a, b) => b.harga - a.harga);
        return products;
    }
}">

    <div x-show="notify" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="bg-white px-8 py-4 rounded-2xl shadow-2xl border-2 border-green-500 flex items-center gap-3">
            <span class="text-2xl">✅</span>
            <span class="font-bold text-gray-800">Berhasil ditambahkan!</span>
        </div>
    </div>

    <nav class="bg-white shadow-md p-4 sticky top-0 z-40 border-b border-gray-100">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black text-green-600">SEMBAKO<span class="text-gray-800">KITA</span></h1>
            <button @click="cartOpen = true" class="bg-green-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-green-700 transition flex items-center gap-2 shadow-lg">
                🛒 Keranjang (<span x-text="cart.length">0</span>)
            </button>
        </div>
    </nav>

    <header class="bg-gradient-to-r from-green-600 to-emerald-500 text-white py-12 shadow-lg">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-black mb-2">Penuhi Kebutuhan Dapur Tanpa Ribet</h2>
            <p class="text-green-100 text-lg">Belanja Kebutuhan Dapur dengan Cepat & Hemat</p>
        </div>
    </header>

    <div class="container mx-auto px-4 mt-8 mb-6">
        <div class="flex items-center justify-center gap-3">
            <div class="bg-green-600 p-2 rounded-lg shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </div>
            <h2 class="text-2xl font-black text-gray-800">Pilih Kategori</h2>
        </div>
    </div>

    <div class="container mx-auto px-4 py-4">
        <div x-show="!selectedCategory" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <template x-for="cat in categories" :key="cat.nama">
                <button @click="selectedCategory = cat.nama" :class="cat.color" class="p-4 rounded-3xl border-2 border-white shadow-sm flex flex-col items-center justify-center gap-3 hover:scale-105 transition-transform duration-200 hover:shadow-xl text-center aspect-square">
                    <img :src="'{{ asset('images/categories') }}/' + cat.file" :alt="cat.nama" class="w-20 h-20 object-contain rounded-full bg-white/50 p-2 shadow-inner">
                    <span class="font-bold text-gray-800" x-text="cat.nama"></span>
                </button>
            </template>
        </div>

        <div x-show="selectedCategory" class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <button @click="selectedCategory = null" class="bg-white px-6 py-3 rounded-full font-bold text-green-600 border-2 border-green-200 hover:bg-green-100 transition shadow-sm">
                ← Kembali ke Semua Kategori
            </button>
            <select x-model="sortBy" class="bg-white border-2 border-green-200 px-4 py-2 rounded-xl font-bold text-green-700 outline-none">
                <option value="default">Urutkan Harga</option>
                <option value="low">Termurah</option>
                <option value="high">Termahal</option>
            </select>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <template x-for="product in filteredProducts.filter(p => p.kategori === selectedCategory)" :key="product.id">
                <div class="bg-green-50 rounded-2xl p-3 shadow-sm border border-green-100 hover:shadow-md transition-all">
                    <div class="relative aspect-square overflow-hidden rounded-xl mb-3 bg-white">
                        <img :src="'{{ asset('images/') }}/' + product.gambar" class="w-full h-full object-cover" :alt="product.nama">
                        <div :class="product.stok > 0 ? 'bg-green-500' : 'bg-red-500'" class="absolute top-2 left-2 text-[10px] text-white px-2 py-1 rounded-full font-bold">
                            <span x-text="product.stok > 0 ? 'Stok: ' + product.stok : 'Habis'"></span>
                        </div>
                    </div>
                    <h2 class="text-sm font-bold text-gray-800 truncate" x-text="product.nama"></h2>
                    <p class="text-green-700 font-black text-sm mb-3">Rp <span x-text="product.harga.toLocaleString()"></span></p>
                    <div class="flex flex-col gap-1.5">
                        <button @click="openDetail(product)" class="w-full bg-gray-200 text-gray-700 py-1.5 rounded-lg text-xs font-bold hover:bg-gray-300 transition">Lihat Detail</button>
                        <button @click="addToCart(product)" :disabled="product.stok <= 0" class="w-full bg-green-600 text-white py-1.5 rounded-lg text-xs font-bold hover:bg-green-700 transition disabled:bg-gray-400">Tambah</button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <div x-show="detailOpen" x-cloak class="fixed inset-0 bg-black/60 z-[200] flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-sm p-6 rounded-3xl shadow-2xl">
            <h2 class="text-xl font-black mb-2" x-text="detailItem?.nama"></h2>
            <p class="text-gray-600 text-sm mb-6" x-text="detailItem?.deskripsi"></p>
            <button @click="detailOpen = false" class="w-full bg-green-600 text-white py-3 rounded-2xl font-bold hover:bg-green-700 transition">Tutup</button>
        </div>
    </div>
</body>
</html>