<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SembakoKita | Belanja Dapur Hemat & Praktis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="bg-gray-50" x-data="{ 
    cartOpen: false, 
    modalOpen: false, 
    selectedProduct: '', 
    nama: '', 
    alamat: '', 
    no_hp: '', 
    cart: [], 
    notify: false,
    selectedCategory: null,
    categories: [
        { nama: 'Beras', icon: '🌾' },
        { nama: 'Bumbu Masakan', icon: '🧂' },
        { nama: 'Detergent', icon: '🧼' },
        { nama: 'Gula Pasir', icon: '🍬' },
        { nama: 'Ikan Kaleng', icon: '🐟' },
        { nama: 'Kecap', icon: '🍶' },
        { nama: 'Kopi Saset', icon: '☕' },
        { nama: 'Makanan Ringan', icon: '🍿' },
        { nama: 'Mie Instant', icon: '🍜' },
        { nama: 'Minuman', icon: '🥤' },
        { nama: 'Minyak Goreng', icon: '🧴' },
        { nama: 'Pasta Gigi', icon: '🦷' }
    ],
    addToCart(product) {
        let exist = this.cart.find(item => item.id === product.id);
        if(exist) { exist.qty++; } 
        else { this.cart.push({...product, qty: 1}); }
        this.notify = true;
        setTimeout(() => this.notify = false, 2000);
    },
    totalHarga() {
        return this.cart.reduce((total, item) => total + (item.harga * item.qty), 0);
    }
}">

    <div x-show="notify" x-transition.opacity class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="bg-white px-8 py-4 rounded-2xl shadow-2xl border border-green-100 flex items-center gap-3 animate-bounce">
            <span class="text-2xl">✅</span>
            <span class="font-bold text-gray-800">Berhasil ditambahkan!</span>
        </div>
    </div>

    <nav class="bg-white shadow-sm p-4 sticky top-0 z-40 border-b">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black text-green-600">SEMBAKO<span class="text-gray-800">KITA</span></h1>
            <button @click="cartOpen = true" class="bg-green-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-green-700 transition">
                🛒 Keranjang (<span x-text="cart.length">0</span>)
            </button>
        </div>
    </nav>

    <header class="bg-green-600 text-white py-12 text-center">
        <h2 class="text-3xl font-bold mb-2">Penuhi Kebutuhan Dapur Tanpa Ribet</h2>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div x-show="!selectedCategory" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <template x-for="cat in categories" :key="cat.nama">
                <button @click="selectedCategory = cat.nama" 
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center gap-3 hover:shadow-lg hover:border-green-200 transition text-center aspect-square">
                    <span class="text-5xl" x-text="cat.icon"></span>
                    <span class="font-bold text-gray-800" x-text="cat.nama"></span>
                </button>
            </template>
        </div>

        <div x-show="selectedCategory" class="mb-6">
            <button @click="selectedCategory = null" class="flex items-center gap-2 text-green-700 font-bold hover:text-green-900 transition">
                <span>← Kembali ke Semua Kategori</span>
            </button>
            <h2 class="text-3xl font-black mt-4 text-gray-900">
                Kategori: <span class="text-green-600" x-text="selectedCategory"></span>
            </h2>
        </div>
    </div>

    <div class="container mx-auto py-6 px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($products as $product)
            <div x-show="selectedCategory === '{{ $product->kategori }}'" 
                 class="bg-white rounded-2xl shadow-md p-5 border border-gray-100 hover:shadow-xl transition-shadow">
                <img src="{{ asset('images/' . $product->gambar) }}" class="w-full h-56 object-cover rounded-xl mb-4">
                <h2 class="text-xl font-bold">{{ $product->nama_produk }}</h2>
                <p class="text-sm text-gray-500 mb-2 font-medium">Berat/Ukuran: {{ $product->berat }}</p>
                <p class="text-green-600 font-bold mb-4">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                <div class="mt-6 flex gap-3">
                    <button @click="addToCart({id: {{ $product->id }}, nama: '{{ $product->nama_produk }}', harga: {{ $product->harga }}})" 
                            class="flex-1 bg-gray-100 py-2 rounded-xl font-semibold hover:bg-gray-200 transition">Keranjang</button>
                    <button @click="modalOpen = true; selectedProduct = '{{ $product->nama_produk }}'" 
                            class="flex-1 bg-green-600 text-white py-2 rounded-xl font-semibold hover:bg-green-700 transition">Pesan</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div x-show="cartOpen" x-cloak class="fixed inset-0 bg-gray-50 z-50 overflow-y-auto p-4 md:p-10">
        <div class="container mx-auto max-w-4xl bg-white p-6 md:p-10 rounded-3xl shadow-2xl">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold">Detail Keranjang Anda</h2>
                <button @click="cartOpen = false" class="bg-gray-200 px-6 py-2 rounded-xl font-bold hover:bg-gray-300">Lanjut Belanja</button>
            </div>
            <div class="space-y-4 mb-10">
                <template x-for="(item, index) in cart" :key="index">
                    <div class="flex items-center justify-between border-b pb-4">
                        <div>
                            <h3 class="font-bold text-lg" x-text="item.nama"></h3>
                            <p class="text-green-600">Rp <span x-text="(item.harga * item.qty).toLocaleString()"></span></p>
                        </div>
                        <div class="flex items-center gap-4">
                            <button @click="item.qty > 1 ? item.qty-- : cart.splice(index, 1)" class="bg-gray-200 px-4 py-2 rounded-lg font-bold">-</button>
                            <span class="font-bold w-8 text-center" x-text="item.qty"></span>
                            <button @click="item.qty++" class="bg-gray-200 px-4 py-2 rounded-lg font-bold">+</button>
                        </div>
                    </div>
                </template>
            </div>
            <div class="grid md:grid-cols-2 gap-6 mb-10">
                <input x-model="nama" type="text" placeholder="Nama Lengkap" class="p-3 rounded-xl border w-full">
                <input x-model="alamat" type="text" placeholder="Alamat" class="p-3 rounded-xl border w-full">
                <input x-model="no_hp" type="text" placeholder="Nomor WA" class="p-3 rounded-xl border w-full col-span-2">
            </div>
            <button @click="window.open(`https://wa.me/083196633554?text=Halo, saya ingin pesan: ${cart.map(i => i.nama + ' ('+i.qty+')').join(', ')}`)" 
                    class="w-full bg-green-600 text-white py-4 rounded-xl font-bold">Checkout WA</button>
        </div>
    </div>
</body>
</html>