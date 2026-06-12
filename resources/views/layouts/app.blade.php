<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SembakoKita | Belanja Dapur Hemat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
    [x-cloak] { display: none !important; }
    .modal-open { overflow: hidden !important; }
</style>
</head>

<body x-data class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen">

    <div x-show="$store.cart.showNotification" 
         x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-10"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         class="fixed top-20 right-3 z-[99999] bg-emerald-600 text-white px-4 py-3 rounded-2xl shadow-xl font-bold text-sm">
        ✅ Berhasil ditambahkan ke keranjang!
    </div>

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-lg border-b border-emerald-100 sticky top-0 z-[500] w-full">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-3 md:py-4 flex justify-between items-center gap-3">
            
            {{-- LOGO --}}
            <h1 class="text-lg md:text-2xl font-black text-emerald-600 tracking-tight flex-shrink-0">
                SEMBAKO<span class="text-gray-800">KITA</span>
            </h1>

            {{-- SEARCH BOX DESKTOP --}}
            <div class="relative flex-1 max-w-md hidden md:block">
                <input type="text" x-model="$store.search.query" 
                       placeholder="Cari produk atau kategori (contoh: beras, kecap, minyak)..." 
                       class="w-full border-2 border-emerald-100 rounded-xl pl-10 pr-10 py-2 text-sm focus:outline-none focus:border-emerald-400 transition">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                <button x-show="$store.search.query" @click="$store.search.query = ''" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 font-bold">
                    ✕
                </button>
            </div>

            {{-- MENU DESKTOP --}}
            <div class="hidden md:flex items-center gap-4 flex-shrink-0">
                <a href="/" class="flex items-center gap-2 font-bold text-gray-700 hover:text-emerald-600 transition">
                    <span>🏠</span> Beranda
                </a>

                <div class="relative" x-data="{ infoOpen: false }">
                    <button @click="infoOpen = !infoOpen" @click.away="infoOpen = false"
                            class="flex items-center gap-2 font-bold text-gray-700 hover:text-emerald-600 transition">
                        <span>ℹ️</span> Info
                        <svg class="w-4 h-4 transition-transform duration-200" :class="infoOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="infoOpen" x-cloak x-transition
                         class="absolute top-12 left-0 bg-white rounded-2xl shadow-xl border border-gray-100 w-52 z-[600] overflow-hidden">
                        <a href="{{ url('/info/hubungi-kami') }}"
                           class="flex items-center gap-3 px-5 py-4 hover:bg-emerald-50 transition font-bold text-gray-700 hover:text-emerald-600">
                            📞 Hubungi Kami
                        </a>
                        <hr class="border-gray-100">
                        <a href="{{ url('/info/metode-pembayaran') }}"
                           class="flex items-center gap-3 px-5 py-4 hover:bg-emerald-50 transition font-bold text-gray-700 hover:text-emerald-600">
                            💳 Metode Pembayaran
                        </a>
                    </div>
                </div>

                <button type="button" @click="$store.profile.open = true" 
                    class="bg-gray-100 text-gray-700 px-4 py-2 rounded-xl font-bold hover:bg-gray-200">
                    👤 Profil
                </button>

                <button type="button" @click="$store.cart.open = true" 
                    class="flex items-center gap-2 bg-emerald-600 text-white px-4 py-2 rounded-xl font-bold cursor-pointer hover:bg-emerald-700 transition">
                    🛒 Keranjang (<span x-text="$store.cart.items.length"></span>)
                </button>
            </div>

            {{-- MENU MOBILE --}}
            <div class="flex md:hidden items-center gap-2" x-data="{ mobileOpen: false }">

                {{-- Tombol Keranjang Mobile --}}
                <button type="button" @click="$store.cart.open = true" 
                    class="flex items-center gap-1 bg-emerald-600 text-white px-3 py-2 rounded-xl font-bold text-sm hover:bg-emerald-700 transition">
                    🛒 <span x-text="$store.cart.items.length"></span>
                </button>

                {{-- Tombol Hamburger --}}
                <button @click="mobileOpen = !mobileOpen"
                        class="bg-gray-100 p-2 rounded-xl font-bold text-gray-700 hover:bg-gray-200 transition">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                {{-- Dropdown Menu Mobile --}}
                <div x-show="mobileOpen" x-cloak x-transition
                     @click.away="mobileOpen = false"
                     class="absolute top-16 right-4 bg-white rounded-2xl shadow-xl border border-gray-100 w-56 z-[600] overflow-hidden">
                    
                    <a href="/" class="flex items-center gap-3 px-5 py-4 hover:bg-emerald-50 transition font-bold text-gray-700 hover:text-emerald-600">
                        🏠 Beranda
                    </a>
                    <hr class="border-gray-100">
                    <a href="{{ url('/info/hubungi-kami') }}"
                       class="flex items-center gap-3 px-5 py-4 hover:bg-emerald-50 transition font-bold text-gray-700 hover:text-emerald-600">
                        📞 Hubungi Kami
                    </a>
                    <hr class="border-gray-100">
                    <a href="{{ url('/info/metode-pembayaran') }}"
                       class="flex items-center gap-3 px-5 py-4 hover:bg-emerald-50 transition font-bold text-gray-700 hover:text-emerald-600">
                        💳 Metode Pembayaran
                    </a>
                    <hr class="border-gray-100">
                    <button type="button" @click="$store.profile.open = true; mobileOpen = false"
                            class="w-full flex items-center gap-3 px-5 py-4 hover:bg-emerald-50 transition font-bold text-gray-700 hover:text-emerald-600">
                        👤 Profil
                    </button>
                </div>
            </div>

        </div>

        {{-- SEARCH BOX MOBILE (baris terpisah di bawah navbar) --}}
        <div class="md:hidden px-4 pb-3">
            <div class="relative">
                <input type="text" x-model="$store.search.query" 
                       placeholder="Cari produk atau kategori..." 
                       class="w-full border-2 border-emerald-100 rounded-xl pl-10 pr-10 py-2 text-sm focus:outline-none focus:border-emerald-400 transition">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                <button x-show="$store.search.query" @click="$store.search.query = ''" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 font-bold">
                    ✕
                </button>
            </div>
        </div>
    </nav>

    {{-- MODAL PROFIL --}}
    <div x-show="$store.profile.open" x-cloak class="fixed inset-0 z-[2000] flex items-end md:items-center justify-center p-0 md:p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white w-full md:max-w-sm rounded-t-3xl md:rounded-3xl p-6 shadow-2xl relative" @click.away="$store.profile.open = false">
            <button @click="$store.profile.open = false" 
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl font-bold">
                &times;
            </button>
            <h2 class="text-xl font-black mb-4">Lengkapi Profil</h2>
            <input type="text" x-model="$store.profile.nama" placeholder="Nama Lengkap" class="w-full border p-3 rounded-lg mb-2">
            <input type="text" x-model="$store.profile.alamat" placeholder="Alamat Rumah" class="w-full border p-3 rounded-lg mb-2">
            <input type="text" x-model="$store.profile.no_hp" placeholder="Nomor HP/WA" class="w-full border p-3 rounded-lg mb-4">
            <button @click="$store.profile.save($store.profile.nama, $store.profile.alamat, $store.profile.no_hp); $store.profile.open = false" 
                    class="w-full bg-emerald-600 text-white py-3 rounded-xl font-bold hover:bg-emerald-700 transition">Simpan Profil</button>
        </div>
    </div>

    {{-- MODAL KERANJANG --}}
<div x-show="$store.cart.open" x-cloak 
     x-effect="$store.cart.open ? document.body.classList.add('modal-open') : document.body.classList.remove('modal-open')"
     class="fixed inset-0 z-[1000] flex items-end md:items-center justify-center p-0 md:p-4 bg-black/60 backdrop-blur-sm">
    
    <div class="bg-white w-full md:max-w-lg rounded-t-3xl md:rounded-3xl shadow-2xl flex flex-col"
         style="max-height: 85vh;"
         @click.away="$store.cart.open = false">
        
        {{-- Header --}}
        <div class="flex items-center justify-between px-5 pt-5 pb-3 flex-shrink-0">
            <h2 class="text-xl md:text-2xl font-black">Keranjang Anda</h2>
            <button @click="$store.cart.open = false" class="text-gray-400 hover:text-red-500 font-black text-xl">✕</button>
        </div>

        {{-- List item scrollable --}}
        <div class="overflow-y-auto flex-1 px-5" style="-webkit-overflow-scrolling: touch; overscroll-behavior: contain;">
            <div class="space-y-3">
                <template x-for="(item, index) in $store.cart.items" :key="item.id + '-' + item.weight + '-' + index">
                    <div class="border-b py-3 flex items-center gap-3">
                        <img :src="'{{ asset('images/') }}/' + item.gambar" class="w-12 h-12 md:w-14 md:h-14 object-cover rounded-xl border border-gray-100 flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-xs md:text-sm truncate" x-text="item.nama"></p>
                            <p class="text-xs md:text-sm text-emerald-600 font-bold">Rp <span x-text="(item.finalPrice * item.qty).toLocaleString('id-ID')"></span></p>
                        </div>
                        <div class="flex items-center gap-1 md:gap-2 flex-shrink-0">
                            <button @click="$store.cart.updateQty(index, -1)" class="bg-gray-200 px-2 md:px-3 py-1 rounded-lg font-bold hover:bg-gray-300 text-sm">-</button>
                            <span class="font-bold w-5 text-center text-sm" x-text="item.qty"></span>
                            <button @click="$store.cart.updateQty(index, 1)" class="bg-emerald-600 text-white px-2 md:px-3 py-1 rounded-lg font-bold hover:bg-emerald-700 text-sm">+</button>
                        </div>
                    </div>
                </template>
                <p x-show="$store.cart.items.length === 0" class="text-gray-400 py-4 italic text-sm">Keranjang kosong</p>
            </div>

            <div x-show="$store.cart.items.length > 0" class="mt-3 pt-3 border-t border-gray-200 pb-2">
                <p class="font-black text-base md:text-lg text-gray-800">Total: Rp <span x-text="$store.cart.items.reduce((sum, item) => sum + (item.finalPrice * item.qty), 0).toLocaleString('id-ID')"></span></p>
            </div>
        </div>

        {{-- Tombol di tengah bawah --}}
        <div class="flex flex-col gap-2 px-5 py-4 flex-shrink-0">
            <button @click="
                if (!$store.profile.isComplete) {
                    alert('Mohon lengkapi profil Anda terlebih dahulu!');
                    $store.profile.open = true;
                } else {
                    let waktu = new Date().getHours();
                    let salam = waktu < 11 ? 'pagi' : waktu < 15 ? 'siang' : waktu < 18 ? 'sore' : 'malam';
                    let nomorList = $store.cart.items.map((i, idx) => 
                        (idx+1) + '. ' + i.nama + ' — ' + i.qty + 'x @ Rp ' + i.finalPrice.toLocaleString('id-ID') + ' = Rp ' + (i.finalPrice * i.qty).toLocaleString('id-ID')
                    ).join('\n');
                    let total = $store.cart.items.reduce((sum, item) => sum + (item.finalPrice * item.qty), 0);
                    let msg = 
                        'Halo! 👋 Selamat ' + salam + ', Admin SembakoKita!\n\n' +
                        'Saya ingin memesan beberapa produk berikut:\n\n' +
                        '🛒 Daftar Pesanan:\n' + nomorList + '\n\n' +
                        '💰 Total Belanja: Rp ' + total.toLocaleString('id-ID') + '\n\n' +
                        '👤 Nama     : ' + $store.profile.nama + '\n' +
                        '📍 Alamat   : ' + $store.profile.alamat + '\n' +
                        '📱 No. HP   : ' + $store.profile.no_hp + '\n\n' +
                        'Mohon konfirmasi ketersediaan stok dan info pengirimannya ya, Admin. Terima kasih! 🙏';
                    
                    $store.cart.items.forEach(item => $store.cart.kirimKeDatabase(item));
                    window.open('https://wa.me/6283196633554?text=' + encodeURIComponent(msg), '_blank');
                    $store.cart.clear();
                    $store.cart.open = false;
                }
            " class="w-full bg-green-500 text-white py-3 rounded-xl font-bold hover:bg-green-600 transition">
                Pesan via WhatsApp
            </button>
            <button @click="$store.cart.open = false" class="w-full bg-gray-100 py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                Lanjut Belanja
            </button>
        </div>
    </div>
</div>

    <main class="relative z-[1]">
        @yield('content')
    </main>

    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('cart', {
            items: JSON.parse(localStorage.getItem('sembako_cart')) || [],
            open: false,
            showNotification: false,
            save() { localStorage.setItem('sembako_cart', JSON.stringify(this.items)); },
            
            async kirimKeDatabase(item) {
                await fetch('/update-stok', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ id: item.id, qty: item.qty })
                });
            },

            clear() {
                this.items = [];
                this.save();
            },

            add(product) {
                let price = parseFloat(product.finalPrice) || 0;
                let existingItem = this.items.find(i => i.nama === product.nama && i.weight === product.weight);
                if (existingItem) { existingItem.qty += 1; } 
                else { this.items.push({ ...product, finalPrice: price, qty: 1 }); }
                this.save();
                this.showNotification = true;
                setTimeout(() => { this.showNotification = false; }, 2000);
            },
            updateQty(index, change) {
                this.items[index].qty += change;
                if (this.items[index].qty < 1) {
                    this.items.splice(index, 1);
                }
                this.items = [...this.items];
                this.save();
            }
        });

        Alpine.store('profile', {
            open: false,
            nama: localStorage.getItem('user_nama') || '',
            alamat: localStorage.getItem('user_alamat') || '',
            no_hp: localStorage.getItem('user_hp') || '',
            save(nama, alamat, no_hp) {
                this.nama = nama;
                this.alamat = alamat;
                this.no_hp = no_hp;
                localStorage.setItem('user_nama', nama);
                localStorage.setItem('user_alamat', alamat);
                localStorage.setItem('user_hp', no_hp);
            },
            get isComplete() {
                return this.nama !== '' && this.alamat !== '' && this.no_hp !== '';
            }
        });

        Alpine.store('search', {
            query: ''
        });
    });
    </script>
</body>
</html>