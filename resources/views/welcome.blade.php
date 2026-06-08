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
    selectedWeight: 5,         // <--- TAMBAHKAN INI
    weights: [5, 10, 25, 50],  // <--- TAMBAHKAN INI
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
    openDetail(product) {
        this.detailItem = product;
        this.detailOpen = true;
    },
    openCheckout(product) {
        this.checkoutItem = product;
        this.checkoutOpen = true;
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

    <nav class="bg-white shadow-md p-4 sticky top-0 z-[60] border-b border-gray-100">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black text-green-600">SEMBAKO<span class="text-gray-800">KITA</span></h1>
            <div class="flex items-center gap-6">
                <button @click="selectedCategory = null" class="text-green-600 font-bold hover:text-green-700 transition">Beranda</button>
                <button @click="cartOpen = true" class="relative z-[70] bg-green-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-green-700 transition flex items-center gap-2 shadow-lg cursor-pointer">
                    🛒 Keranjang (<span x-text="cart.length">0</span>)
                </button>
            </div>
        </div>
    </nav>

   <div x-show="cartOpen" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="bg-white w-full max-w-sm rounded-3xl p-6 shadow-2xl" @click.away="cartOpen = false">
        <h2 class="text-xl font-black mb-4">Keranjang Anda</h2>
        
        <div class="max-h-80 overflow-y-auto mb-4 space-y-3">
            <template x-for="(item, index) in cart" :key="item.id">
                <div class="flex items-center gap-3 border-b pb-3">
                    <img :src="'{{ asset('images/') }}/' + item.gambar" class="w-16 h-16 object-cover rounded-lg border">
                    <div class="flex-1">
                        <h3 class="font-bold text-sm" x-text="item.nama"></h3>
                        <p class="text-green-600 text-xs">Rp <span x-text="(item.harga * item.qty).toLocaleString()"></span></p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button @click="item.qty > 1 ? item.qty-- : cart.splice(index, 1)" class="bg-gray-100 px-2 py-1 rounded font-bold">-</button>
                        <span class="font-bold" x-text="item.qty"></span>
                        <button @click="item.qty++" class="bg-gray-100 px-2 py-1 rounded font-bold">+</button>
                    </div>
                </div>
            </template>
            <p x-show="cart.length === 0" class="text-gray-400 text-center py-4">Keranjang masih kosong.</p>
        </div>

        <div x-show="cart.length > 0" class="border-t pt-4 mt-2 mb-4 bg-gray-50 p-3 rounded-2xl">
            <div class="flex justify-between items-center">
                <span class="font-bold text-gray-600">Total Harga:</span>
                <span class="font-black text-green-700 text-lg">
                    Rp <span x-text="cart.reduce((total, item) => total + (item.harga * item.qty), 0).toLocaleString()"></span>
                </span>
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <button @click="cartOpen = false" class="w-full bg-gray-100 py-3 rounded-2xl font-bold">Lanjut Belanja</button>
            <button @click="if(cart.length > 0) { checkoutItem = {nama: cart.map(i => i.nama + ' ('+i.qty+'x)').join(', ')}; checkoutOpen = true; cartOpen = false; } else { alert('Keranjang kosong!'); }" 
                    class="w-full bg-green-600 text-white py-3 rounded-2xl font-bold shadow-lg">
                Pesan via WhatsApp
            </button>
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

   <div x-show="detailOpen" x-cloak class="fixed inset-0 z-[200] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
    <div class="bg-white p-6 rounded-3xl w-full max-w-sm shadow-2xl">
        <img :src="'{{ asset('images/') }}/' + detailItem?.gambar" class="w-full h-40 object-cover rounded-2xl mb-4">
        
        <h2 class="text-2xl font-black mb-1" x-text="detailItem?.nama"></h2>
        
        <div class="my-4">
            <p class="text-sm font-bold text-gray-600 mb-2">Pilih Berat:</p>
            <div class="grid grid-cols-4 gap-2">
                <template x-for="w in weights" :key="w">
                    <button @click="selectedWeight = w" 
                            :class="selectedWeight === w ? 'bg-green-600 text-white' : 'bg-gray-100'"
                            class="py-2 rounded-lg font-bold text-xs transition" 
                            x-text="w + 'kg'">
                    </button>
                </template>
            </div>
        </div>
        
        <div class="bg-gray-50 p-4 rounded-xl mb-6">
            <p class="text-gray-700 text-sm" x-text="detailItem?.deskripsi"></p>
            <p class="text-green-600 font-bold mt-2">
                Rp <span x-text="(detailItem?.harga * (selectedWeight / 5)).toLocaleString()"></span>
            </p>
        </div>
        
        <button @click="addToCart({...detailItem, harga: detailItem.harga * (selectedWeight/5), nama: detailItem.nama + ' (' + selectedWeight + 'kg)'}); detailOpen = false" 
                class="w-full bg-green-600 text-white py-3 rounded-2xl font-bold mb-2">
            Masukkan Keranjang
        </button>
        <button @click="openCheckout(detailItem); detailOpen = false" class="w-full bg-green-600 text-white py-3 rounded-2xl font-bold mb-2">Beli Sekarang</button>
        <button @click="detailOpen = false" class="w-full text-gray-400 font-bold">Tutup</button>
    </div>
</div>

    <div x-show="checkoutOpen" x-cloak class="fixed inset-0 z-[210] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white p-6 rounded-3xl w-full max-w-sm shadow-2xl">
            <h2 class="text-xl font-black mb-4">Lengkapi Biodata</h2>
            <input x-model="nama" placeholder="Nama Lengkap" class="w-full border-2 border-green-100 p-3 rounded-xl mb-3">
            <input x-model="alamat" placeholder="Alamat Lengkap" class="w-full border-2 border-green-100 p-3 rounded-xl mb-3">
            <input x-model="no_hp" placeholder="Nomor WhatsApp" class="w-full border-2 border-green-100 p-3 rounded-xl mb-4">
            <button @click="if(nama && alamat && no_hp) { let msg = `Halo, saya ingin membeli ${checkoutItem.nama}.%0ANama: ${nama}%0AAlamat: ${alamat}%0ANo HP: ${no_hp}`; window.open('https://wa.me/6281234567890?text=' + msg, '_blank'); checkoutOpen = false; } else { alert('Mohon lengkapi semua data!'); }" class="w-full bg-green-600 text-white py-3 rounded-xl font-bold">Pesan via WhatsApp</button>
            <button @click="checkoutOpen = false" class="w-full mt-2 text-gray-400 font-bold">Batal</button>
        </div>
    </div>
</body>
</html>