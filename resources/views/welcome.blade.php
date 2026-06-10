@extends('layouts.app')

@section('content')
<div x-data="{ 
    detailOpen: false, selectedWeight: 5, weights: [5, 10, 25, 50],
    detailItem: null, 
    checkoutItem: null, checkoutOpen: false, 
    // Mengasumsikan data profil ada di $store.profile
    // Jika $store.profile.nama atau alamat kosong, dianggap belum lengkap
    isProfileComplete: {{ (Auth::check() && Auth::user()->nama && Auth::user()->alamat) ? 'true' : 'false' }},
    
    nama: '', alamat: '', no_hp: '',
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
    
    // Fungsi validasi WhatsApp
    sendCheckoutWhatsApp() {
        if (!this.isProfileComplete) {
            alert('Mohon lengkapi profil Anda (Nama & Alamat) terlebih dahulu!');
            window.location.href = '/profile'; // Ganti dengan route halaman profil Anda
            return;
        }
        let msg = 'Halo, saya ingin memesan ' + this.checkoutItem.nama + ' sebanyak ' + this.checkoutItem.qty;
        window.open('https://wa.me/083196633554?text=' + encodeURIComponent(msg), '_blank');
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
    }
}" x-init="rawProducts = {{ json_encode($products) }}">
    
    <header class="bg-gradient-to-r from-green-600 to-emerald-500 text-white py-12 shadow-lg">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-black mb-2">Penuhi Kebutuhan Dapur Tanpa Ribet</h2>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="relative flex flex-col items-center justify-center mb-6">
            <h2 class="text-3xl font-black text-gray-800 flex items-center gap-3 mb-4">
                <span class="text-emerald-600">📋</span> 
                <span x-text="selectedCategory ? selectedCategory : 'KATEGORI'"></span>
            </h2>
            <div x-show="selectedCategory" class="md:absolute md:right-0 mt-2 md:mt-0">
                <select x-model="sortBy" class="bg-white border-2 border-emerald-200 px-4 py-2 rounded-xl font-bold text-emerald-700">
                    <option value="default">Urutkan Harga</option>
                    <option value="low">Termurah</option>
                    <option value="high">Termahal</option>
                </select>
            </div>
        </div>

        <div x-show="!selectedCategory" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <template x-for="cat in categories" :key="cat.nama">
                <button @click="selectedCategory = cat.nama" :class="cat.color" class="p-4 rounded-3xl border-2 border-white shadow-sm flex flex-col items-center justify-center gap-2 hover:scale-105 transition aspect-square">
                    <img :src="'{{ asset('images/categories') }}/' + cat.file" class="w-14 h-14 object-contain rounded-full bg-white/50 p-1">
                    <span class="font-bold text-gray-800 text-sm" x-text="cat.nama"></span>
                </button>
            </template>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" x-show="selectedCategory">
            <template x-for="product in filteredProducts.filter(p => p.kategori === selectedCategory)" :key="product.id">
                <div class="bg-green-50 rounded-2xl p-3 shadow-sm border border-green-100 flex flex-col relative cursor-pointer" @click="openDetail(product)">
                    <img :src="'{{ asset('images/') }}/' + product.gambar" class="w-full aspect-square object-cover rounded-xl mb-3">
                    <h2 class="text-sm font-bold text-gray-800 truncate" x-text="product.nama"></h2>
                    <p class="text-emerald-700 font-black text-sm mb-3">Rp <span x-text="product.harga.toLocaleString('id-ID')"></span></p>
                    
                    <button type="button" 
                            @click.stop="openCheckout(product)" 
                            class="w-full bg-orange-500 text-white py-2 rounded-lg text-xs font-bold hover:bg-orange-600 transition relative z-20">
                        Beli Sekarang
                    </button>
                </div>
            </template>
        </div>
    </div>

    <div x-show="checkoutOpen" x-cloak class="fixed inset-0 z-[3000] bg-black/50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-6 max-w-sm w-full shadow-2xl relative" @click.away="checkoutOpen = false">
            <button @click="checkoutOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 font-black text-xl">✕</button>
            <img :src="'{{ asset('images/') }}/' + checkoutItem?.gambar" class="w-full h-40 object-cover rounded-2xl mb-4">
            <h2 class="text-xl font-black text-gray-800" x-text="checkoutItem?.nama"></h2>
            <p class="text-emerald-600 font-bold mb-4">Rp <span x-text="(checkoutItem?.harga * checkoutItem?.qty).toLocaleString('id-ID')"></span></p>
            <div class="flex items-center justify-center gap-4 mb-6">
                <button @click="if(checkoutItem.qty > 1) checkoutItem.qty--" class="bg-gray-100 px-4 py-2 rounded-xl font-bold">-</button>
                <span class="font-black text-lg" x-text="checkoutItem?.qty"></span>
                <button @click="checkoutItem.qty++" class="bg-emerald-600 text-white px-4 py-2 rounded-xl font-bold">+</button>
            </div>
            <button @click="sendCheckoutWhatsApp()" 
                    class="w-full bg-green-500 text-white py-3 rounded-xl font-bold hover:bg-green-600 transition">
                Pesan via WhatsApp
            </button>
        </div>
    </div>

    <div x-show="detailOpen" x-cloak class="fixed inset-0 z-[2000] bg-gradient-to-br from-emerald-50 to-white flex flex-col overflow-y-auto">
        <div class="container mx-auto px-6 py-6">
            <button @click="detailOpen = false" class="flex items-center gap-2 bg-white border-2 border-emerald-100 text-gray-700 px-5 py-2 rounded-xl font-bold hover:bg-emerald-50 hover:border-emerald-200 transition shadow-sm mb-4">
                <span>⬅️</span> Kembali
            </button>
        </div>
        <div class="flex-grow flex items-center justify-center p-4">
            <div class="max-w-4xl w-full grid md:grid-cols-2 gap-10 bg-white p-8 rounded-[2rem] shadow-2xl border border-green-100" @click.away="detailOpen = false">
                <img :src="'{{ asset('images/') }}/' + detailItem?.gambar" class="w-full aspect-square object-cover rounded-3xl shadow-lg">
                <div class="flex flex-col justify-center">
                    <h2 class="text-4xl font-black text-gray-900 mb-2" x-text="detailItem?.nama"></h2>
                    <p class="text-3xl font-black text-emerald-600 mb-6">
                        Rp <span x-text="(detailItem?.kategori === 'Beras') ? (detailItem.harga * (selectedWeight / 5)).toLocaleString('id-ID') : detailItem?.harga.toLocaleString('id-ID')"></span>
                    </p>
                    <div class="mb-6">
                        <p class="font-bold text-gray-700 mb-1">Deskripsi:</p>
                        <p class="text-gray-600 leading-relaxed" x-text="detailItem?.deskripsi"></p>
                    </div>
                    <div class="mb-6" x-show="detailItem?.kategori === 'Beras'">
                        <p class="font-bold mb-2">Pilih Berat:</p>
                        <div class="grid grid-cols-4 gap-2">
                            <template x-for="w in weights" :key="w">
                                <button type="button" @click="selectedWeight = w" 
                                        :class="selectedWeight === w ? 'bg-emerald-600 text-white' : 'bg-white border border-green-200 hover:bg-green-100'" 
                                        class="py-3 rounded-2xl font-bold transition" x-text="w + ' kg'">
                                </button>
                            </template>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click.stop="$store.cart.add({nama: detailItem.nama, finalPrice: (detailItem.kategori === 'Beras') ? (detailItem.harga * (selectedWeight / 5)) : detailItem.harga, gambar: detailItem.gambar, weight: (detailItem.kategori === 'Beras') ? selectedWeight : 0, qty: 1});" class="flex-1 bg-emerald-600 text-white py-3 rounded-xl font-bold text-sm hover:bg-emerald-700 transition shadow-md">+ Keranjang</button>
                        <button type="button" @click="let msg = 'Halo, saya ' + $store.profile.nama + ' dari ' + $store.profile.alamat + '. Ingin memesan ' + detailItem.nama + (detailItem.kategori === 'Beras' ? ' (' + selectedWeight + 'kg)' : '') + '. Kontak: ' + $store.profile.no_hp; window.open('https://wa.me/083196633554?text=' + encodeURIComponent(msg), '_blank');" class="flex-1 bg-green-500 text-white py-3 rounded-xl font-bold text-sm hover:bg-green-600 transition shadow-md">WhatsApp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection