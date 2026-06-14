@extends('layouts.app')

@section('content')
<div x-data="{ 
    detailOpen: false, selectedWeight: 5, weights: [5, 10, 25, 50],
    detailItem: null, 
    checkoutItem: null, checkoutOpen: false, 
    
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
    openDetail(product) { this.detailItem = product; this.selectedWeight = 5; this.detailOpen = true; },
    openCheckout(product) { this.checkoutItem = { ...product, qty: 1 }; this.checkoutOpen = true; },
    
    reduceStock(productId, qty) {
        let product = this.rawProducts.find(p => p.id === productId);
        if (product) {
            product.stok = parseInt(product.stok) - qty;
        }
    },
    
    sendCheckoutWhatsApp() {
    if (!$store.profile.isComplete) {
        alert('Mohon lengkapi profil Anda (Nama, Alamat, dan No HP) di menu Profil terlebih dahulu!');
        $store.profile.open = true;
        return;
    }
    let subtotal = this.checkoutItem.harga * this.checkoutItem.qty;
    let waktu = new Date().getHours();
    let salam = waktu < 11 ? 'pagi' : waktu < 15 ? 'siang' : waktu < 18 ? 'sore' : 'malam';
    let msg = 
        'Halo! Selamat ' + salam + ', Admin SembakoKita!\n\n' +
        'Saya ingin melakukan pemesanan produk berikut:\n\n' +
        'Produk   : ' + this.checkoutItem.nama + '\n' +
        'Harga    : Rp ' + this.checkoutItem.harga.toLocaleString('id-ID') + '\n' +
        'Jumlah   : ' + this.checkoutItem.qty + ' pcs\n' +
        'Subtotal : Rp ' + subtotal.toLocaleString('id-ID') + '\n\n' +
        'Nama     : ' + $store.profile.nama + '\n' +
        'Alamat   : ' + $store.profile.alamat + '\n' +
        'No. HP   : ' + $store.profile.no_hp + '\n\n' +
        'Mohon konfirmasi ketersediaan stok dan info pengirimannya ya, Admin. Terima kasih!';
    
    window.open('https://wa.me/6283196633554?text=' + encodeURIComponent(msg), '_blank');
    this.reduceStock(this.checkoutItem.id, this.checkoutItem.qty);
    $store.cart.kirimKeDatabase({id: this.checkoutItem.id, qty: this.checkoutItem.qty});
    this.checkoutOpen = false;
},

    get filteredProducts() {
        let list = this.rawProducts.map(p => ({
            id: p.id, nama: p.nama_produk, harga: parseInt(p.harga),
            kategori: p.kategori, gambar: p.gambar, stok: parseInt(p.stok || 0),
            deskripsi: p.deskripsi || 'Belum ada deskripsi untuk produk ini.'
        }));
        if (this.sortBy === 'low') list.sort((a, b) => a.harga - b.harga);
        if (this.sortBy === 'high') list.sort((a, b) => b.harga - a.harga);
        return list;
    },

    get searchResults() {
        let q = $store.search.query.trim().toLowerCase();
        if (!q) return [];
        let list = this.rawProducts.map(p => ({
            id: p.id, nama: p.nama_produk, harga: parseInt(p.harga),
            kategori: p.kategori, gambar: p.gambar, stok: parseInt(p.stok || 0),
            deskripsi: p.deskripsi || 'Belum ada deskripsi untuk produk ini.'
        }));
        return list.filter(p => 
            p.nama.toLowerCase().includes(q) || p.kategori.toLowerCase().includes(q)
        );
    }
}" x-init="rawProducts = {{ json_encode($products) }}">
    
    {{-- HERO BANNER --}}
<div class="container mx-auto px-4 mt-6" x-show="!$store.search.query.trim()">
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-3xl p-6 shadow-xl flex items-center justify-between overflow-hidden relative min-h-[140px] md:min-h-[180px]">
        
        <div class="hidden md:flex w-40 h-full items-center justify-center">
            <img src="{{ asset('images/orang_belanja-removebg-preview.png') }}" class="w-full h-full object-contain" alt="Ibu Belanja">
        </div>

        <div class="text-center flex-1 px-2 md:px-6 text-white">
            <h2 class="text-2xl md:text-4xl font-black mb-2">Belanja Dapur</h2>
            <p class="font-bold text-emerald-50 text-sm md:text-lg">Penuhi kebutuhanmu tanpa ribet!</p>
        </div>

        {{-- Gambar khusus HP (kanan) --}}
        <div class="flex md:hidden w-24 h-24 items-center justify-center flex-shrink-0">
            <img src="{{ asset('images/keranjang-removebg-preview.png') }}" class="w-full h-full object-contain" alt="Keranjang Sembako">
        </div>

        {{-- Gambar laptop kanan --}}
        <div class="hidden md:flex w-40 h-full items-center justify-center">
            <img src="{{ asset('images/keranjang-removebg-preview.png') }}" class="w-full h-full object-contain" alt="Keranjang Sembako">
        </div>

    </div>
</div>

    {{-- HASIL PENCARIAN --}}
    <div x-show="$store.search.query.trim()" x-cloak class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl md:text-3xl font-black text-gray-800 flex items-center gap-2">
                <span class="text-emerald-600">🔍</span> 
                Hasil Pencarian: "<span x-text="$store.search.query"></span>"
            </h2>
            <button @click="$store.search.query = ''" 
                class="bg-gray-100 text-gray-600 px-3 py-2 rounded-xl font-bold text-xs md:text-sm hover:bg-gray-200 transition flex-shrink-0">
                ✕ Hapus
            </button>
        </div>

        {{-- Jika ada hasil --}}
        <div x-show="searchResults.length > 0" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
            <template x-for="product in searchResults" :key="product.id">
                <div class="bg-green-50 rounded-2xl p-2 md:p-3 shadow-sm border border-green-100 flex flex-col relative cursor-pointer" @click="openDetail(product)">
                    <div class="w-full aspect-square rounded-xl mb-2 overflow-hidden bg-white">
                        <img :src="'{{ asset('images/') }}/' + product.gambar" 
                             class="w-full h-full object-cover">
                    </div>
                    <p class="text-emerald-600 font-bold text-[10px] md:text-xs mb-1" x-text="product.kategori"></p>
                    <h2 class="text-xs md:text-sm font-bold text-gray-800 truncate mb-1" x-text="product.nama"></h2>
                    <p class="text-emerald-700 font-black text-xs md:text-sm mb-2">Rp <span x-text="product.harga.toLocaleString('id-ID')"></span></p>
                    <button type="button" @click.stop="openCheckout(product)" 
                        class="w-full bg-orange-500 text-white py-1.5 rounded-lg text-xs font-bold hover:bg-orange-600 transition relative z-20">
                        Beli Sekarang
                    </button>
                </div>
            </template>
        </div>

        {{-- Jika tidak ada hasil --}}
        <div x-show="searchResults.length === 0" class="text-center py-16">
            <div class="text-5xl mb-3">😕</div>
            <p class="text-gray-500 font-bold">Produk tidak ditemukan</p>
            <p class="text-gray-400 text-sm mt-1">Coba kata kunci lain seperti nama produk atau kategori</p>
        </div>
    </div>

    {{-- KATEGORI --}}
    <div class="container mx-auto px-4 py-6" x-show="!$store.search.query.trim()" x-cloak>
        <div class="relative flex flex-col items-center justify-center mb-5">
            <h2 class="text-2xl md:text-3xl font-black text-gray-800 flex items-center gap-3 mb-4">
                <span class="text-emerald-600">📋</span> 
                <span x-text="selectedCategory ? selectedCategory : 'KATEGORI'"></span>
            </h2>
            <div x-show="selectedCategory" class="md:absolute md:right-0 mt-2 md:mt-0">
                <select x-model="sortBy" class="bg-white border-2 border-emerald-200 px-4 py-2 rounded-xl font-bold text-emerald-700 text-sm">
                    <option value="default">Urutkan Harga</option>
                    <option value="low">Termurah</option>
                    <option value="high">Termahal</option>
                </select>
            </div>
        </div>

        {{-- GRID KATEGORI - diperbaiki agar seragam --}}
<div x-show="!selectedCategory" class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
    <template x-for="cat in categories" :key="cat.nama">
        <button @click="selectedCategory = cat.nama" :class="cat.color" 
            class="rounded-2xl border-2 border-white shadow-sm flex flex-col items-center justify-center gap-2 hover:scale-105 transition aspect-square p-2">
            <div class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-full bg-white/60 flex-shrink-0 overflow-hidden">
                <img :src="'{{ asset('images/categories') }}/' + cat.file" 
                     class="w-full h-full object-cover rounded-full">
            </div>
            <span class="font-bold text-gray-800 text-xs text-center leading-tight w-full px-1" x-text="cat.nama"></span>
        </button>
    </template>
</div>

        {{-- GRID PRODUK --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3" x-show="selectedCategory">
            <template x-for="product in filteredProducts.filter(p => p.kategori === selectedCategory)" :key="product.id">
                <div class="bg-green-50 rounded-2xl p-2 md:p-3 shadow-sm border border-green-100 flex flex-col relative cursor-pointer" @click="openDetail(product)">
                    <div class="w-full aspect-square rounded-xl mb-2 overflow-hidden bg-white">
                        <img :src="'{{ asset('images/') }}/' + product.gambar" 
                             class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-xs md:text-sm font-bold text-gray-800 truncate mb-1" x-text="product.nama"></h2>
                    <p class="text-emerald-700 font-black text-xs md:text-sm mb-2">Rp <span x-text="product.harga.toLocaleString('id-ID')"></span></p>
                    <button type="button" @click.stop="openCheckout(product)" 
                        class="w-full bg-orange-500 text-white py-1.5 rounded-lg text-xs font-bold hover:bg-orange-600 transition relative z-20">
                        Beli Sekarang
                    </button>
                </div>
            </template>
        </div>
    </div>



    {{-- ARTIKEL --}}
<div x-show="!selectedCategory && !$store.search.query.trim()" x-cloak class="container mx-auto px-4 pb-8 pt-4">
        <h2 class="text-xl md:text-3xl font-black text-gray-800 mb-4 flex items-center gap-2">
            <span class="text-emerald-600">💡</span> Artikel Sembako Terkini
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
            <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <h3 class="font-bold text-sm md:text-base text-emerald-800 mb-1">Tips Belanja Sembako Lebih Hemat</h3>
                    <p class="text-emerald-700 text-xs md:text-sm mb-3">Pelajari cara mengatur daftar belanja agar kebutuhan dapur terpenuhi tanpa boros.</p>
                </div>
                <a href="{{ url('/artikel/belanja-hemat') }}" class="bg-emerald-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold hover:bg-emerald-700 transition inline-block w-fit">Baca Selengkapnya</a>
            </div>
            <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <h3 class="font-bold text-sm md:text-base text-emerald-800 mb-1">Mitra Sembako Indonesia</h3>
                    <p class="text-emerald-700 text-xs md:text-sm mb-3">Temukan distributor dan mitra sembako terpercaya di seluruh Indonesia untuk kebutuhan usaha Anda.</p>
                </div>
                <a href="https://mitra-sembako.id/" target="_blank" class="bg-emerald-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold hover:bg-emerald-700 transition inline-block w-fit">Kunjungi Website</a>
            </div>
            <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <h3 class="font-bold text-sm md:text-base text-emerald-800 mb-1">Info Harga Sembako Nasional</h3>
                    <p class="text-emerald-700 text-xs md:text-sm mb-3">Cek update harga bahan pokok terkini dari website resmi pemantauan harga pasar.</p>
                </div>
                <a href="https://sp2kp.kemendag.go.id/" target="_blank" class="bg-emerald-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold hover:bg-emerald-700 transition inline-block w-fit">Kunjungi Website</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <h3 class="font-bold text-sm md:text-base text-emerald-800 mb-1">Mengenal Jenis-Jenis Minyak Goreng</h3>
                    <p class="text-emerald-700 text-xs md:text-sm mb-3">Ketahui perbedaan minyak goreng sawit, kelapa, dan minyak sehat lainnya.</p>
                </div>
                <a href="{{ url('/artikel/minyak-goreng') }}" class="bg-emerald-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold hover:bg-emerald-700 transition inline-block w-fit">Baca Selengkapnya</a>
            </div>
            <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <h3 class="font-bold text-sm md:text-base text-emerald-800 mb-1">Tips Menyimpan Mie Instan dan Snack</h3>
                    <p class="text-emerald-700 text-xs md:text-sm mb-3">Cara menjaga kualitas makanan kemasan agar tetap aman dikonsumsi.</p>
                </div>
                <a href="{{ url('/artikel/mie-instan') }}" class="bg-emerald-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold hover:bg-emerald-700 transition inline-block w-fit">Baca Selengkapnya</a>
            </div>
            <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100 shadow-sm hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <h3 class="font-bold text-sm md:text-base text-emerald-800 mb-1">Strategi Belanja Bulanan Keluarga</h3>
                    <p class="text-emerald-700 text-xs md:text-sm mb-3">Atur anggaran sembako bulanan agar kebutuhan rumah tangga tetap terkendali.</p>
                </div>
                <a href="{{ url('/artikel/belanja-bulanan') }}" class="bg-emerald-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold hover:bg-emerald-700 transition inline-block w-fit">Baca Selengkapnya</a>
            </div>
        </div>
    </div>

    {{-- MODAL CHECKOUT --}}
<div x-show="checkoutOpen" x-cloak class="fixed inset-0 z-[3000] bg-black/50 flex items-end md:items-center justify-center p-0 md:p-4">
    <div class="bg-white rounded-t-3xl md:rounded-3xl w-full md:max-w-sm shadow-2xl relative max-h-[90vh] overflow-y-auto" @click.away="checkoutOpen = false">
        <div class="p-6">
            <button @click="checkoutOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 font-black text-xl">✕</button>
            <img :src="'{{ asset('images/') }}/' + checkoutItem?.gambar" class="w-full h-36 md:h-40 object-cover rounded-2xl mb-4">
            <h2 class="text-lg md:text-xl font-black text-gray-800" x-text="checkoutItem?.nama"></h2>
            <p class="text-emerald-600 font-bold mb-4 text-sm md:text-base">Rp <span x-text="(checkoutItem?.harga * checkoutItem?.qty).toLocaleString('id-ID')"></span></p>
            <div class="flex items-center justify-center gap-4 mb-5">
                <button @click="if(checkoutItem.qty > 1) checkoutItem.qty--" class="bg-gray-100 px-4 py-2 rounded-xl font-bold">-</button>
                <span class="font-black text-lg" x-text="checkoutItem?.qty"></span>
                <button @click="checkoutItem.qty++" class="bg-emerald-600 text-white px-4 py-2 rounded-xl font-bold">+</button>
            </div>
            <button @click="sendCheckoutWhatsApp()" class="w-full bg-green-500 text-white py-3 rounded-xl font-bold hover:bg-green-600 transition">
                Pesan via WhatsApp
            </button>
        </div>
    </div>
</div>

    {{-- MODAL DETAIL --}}
    <div x-show="detailOpen" x-cloak class="fixed inset-0 z-[2000] bg-gradient-to-br from-emerald-50 to-white flex flex-col overflow-y-auto">
        <div class="container mx-auto px-4 py-4">
            <button @click="detailOpen = false" class="flex items-center gap-2 bg-white border-2 border-emerald-100 text-gray-700 px-4 py-2 rounded-xl font-bold hover:bg-emerald-50 transition shadow-sm text-sm">
                <span>⬅️</span> Kembali
            </button>
        </div>
        <div class="flex-grow flex items-start md:items-center justify-center p-4">
            <div class="max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 bg-white p-5 md:p-8 rounded-3xl shadow-2xl border border-green-100" @click.away="detailOpen = false">
                <img :src="'{{ asset('images/') }}/' + detailItem?.gambar" class="w-full aspect-square object-cover rounded-2xl shadow-lg">
                <div class="flex flex-col justify-center">
                    <h2 class="text-2xl md:text-4xl font-black text-gray-900 mb-2" x-text="detailItem?.nama"></h2>
                    <p class="text-xl md:text-3xl font-black text-emerald-600 mb-4">
                        Rp <span x-text="(detailItem?.kategori === 'Beras') ? (detailItem.harga * (selectedWeight / 5)).toLocaleString('id-ID') : detailItem?.harga.toLocaleString('id-ID')"></span>
                    </p>
                    <div class="mb-4">
                        <p class="font-bold text-gray-700 mb-1 text-sm">Deskripsi:</p>
                        <p class="text-gray-600 leading-relaxed text-sm" x-text="detailItem?.deskripsi"></p>
                    </div>
                    <div class="mb-4" x-show="detailItem?.kategori === 'Beras'">
                        <p class="font-bold mb-2 text-sm">Pilih Berat:</p>
                        <div class="grid grid-cols-4 gap-2">
                            <template x-for="w in weights" :key="w">
                                <button type="button" @click="selectedWeight = w" 
                                    :class="selectedWeight === w ? 'bg-emerald-600 text-white' : 'bg-white border border-green-200 hover:bg-green-100'" 
                                    class="py-2 md:py-3 rounded-2xl font-bold transition text-sm" x-text="w + ' kg'"></button>
                            </template>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click.stop="$store.cart.add({id: detailItem.id, nama: detailItem.nama, finalPrice: (detailItem.kategori === 'Beras') ? (detailItem.harga * (selectedWeight / 5)) : detailItem.harga, gambar: detailItem.gambar, weight: (detailItem.kategori === 'Beras') ? selectedWeight : 0, qty: 1});" 
                            class="flex-1 bg-emerald-600 text-white py-3 rounded-xl font-bold text-xs md:text-sm hover:bg-emerald-700 transition shadow-md">+ Keranjang</button>
                        <button type="button" @click="
                            if (!$store.profile.isComplete) {
                                alert('Mohon lengkapi profil Anda terlebih dahulu!');
                                $store.profile.open = true;
                            } else {
                                let harga = (detailItem.kategori === 'Beras') ? (detailItem.harga * (selectedWeight / 5)) : detailItem.harga;
                                let namaLengkap = detailItem.nama + (detailItem.kategori === 'Beras' ? ' (' + selectedWeight + 'kg)' : '');
                                let waktu = new Date().getHours();
                                let salam = waktu < 11 ? 'pagi' : waktu < 15 ? 'siang' : waktu < 18 ? 'sore' : 'malam';
                                let msg = 
                                    'Halo! 👋 Selamat ' + salam + ', Admin SembakoKita!\n\n' +
                                    'Saya ingin melakukan pemesanan produk berikut:\n\n' +
                                    '🛍 Produk   : ' + namaLengkap + '\n' +
                                    '💰 Harga    : Rp ' + harga.toLocaleString('id-ID') + '\n' +
                                    '📦 Jumlah   : 1 pcs\n' +
                                    '💵 Subtotal : Rp ' + harga.toLocaleString('id-ID') + '\n\n' +
                                    '👤 Nama     : ' + $store.profile.nama + '\n' +
                                    '📍 Alamat   : ' + $store.profile.alamat + '\n' +
                                    '📱 No. HP   : ' + $store.profile.no_hp + '\n\n' +
                                    'Mohon konfirmasi ketersediaan stok dan info pengirimannya ya, Admin. Terima kasih! 🙏';
                                window.open('https://wa.me/6283196633554?text=' + encodeURIComponent(msg), '_blank');
                                reduceStock(detailItem.id, 1);
                                $store.cart.kirimKeDatabase({id: detailItem.id, qty: 1});
                            }" 
                            class="flex-1 bg-green-500 text-white py-3 rounded-xl font-bold text-xs md:text-sm hover:bg-green-600 transition shadow-md">WhatsApp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection