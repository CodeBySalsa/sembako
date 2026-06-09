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

<body x-data class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen">

    <div x-show="$store.cart.showNotification" 
         x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-10"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         class="fixed top-20 right-5 z-[99999] bg-emerald-600 text-white px-6 py-3 rounded-2xl shadow-xl font-bold">
        ✅ Berhasil ditambahkan ke keranjang!
    </div>

    <nav class="bg-white shadow-lg border-b border-emerald-100 sticky top-0 z-[500] w-full">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-black text-emerald-600 tracking-tight">SEMBAKO<span class="text-gray-800">KITA</span></h1>
            <div class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-2 font-bold text-gray-700 hover:text-emerald-600 transition">
    <span>🏠</span> Beranda
</a>
                
                <button type="button" @click="$store.profile.open = true" 
                    class="bg-gray-100 text-gray-700 px-4 py-2 rounded-xl font-bold hover:bg-gray-200">
                    👤 Profil
                </button>

                <button type="button" @click="$store.cart.open = true" 
                    class="flex items-center gap-2 bg-emerald-600 text-white px-4 py-2 rounded-xl font-bold cursor-pointer hover:bg-emerald-700 transition">
                    🛒 Keranjang (<span x-text="$store.cart.items.length"></span>)
                </button>
            </div>
        </div>
    </nav>

    <div x-show="$store.profile.open" x-cloak class="fixed inset-0 z-[2000] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-sm rounded-3xl p-6 shadow-2xl relative" @click.away="$store.profile.open = false">
            
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

    <div x-show="$store.cart.open" x-cloak class="fixed inset-0 z-[1000] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-lg rounded-3xl p-8 shadow-2xl relative" @click.away="$store.cart.open = false">
            <h2 class="text-2xl font-black mb-4">Keranjang Anda</h2>
            <div class="max-h-[60vh] overflow-y-auto pr-2 space-y-4">
                <template x-for="(item, index) in $store.cart.items" :key="index">
                    <div class="border-b py-3 flex items-center gap-4">
                        <img :src="'{{ asset('images/') }}/' + item.gambar" class="w-14 h-14 object-cover rounded-xl border border-gray-100">
                        <div class="flex-1">
                            <p class="font-bold text-sm" x-text="item.nama"></p>
                            <p class="text-sm text-emerald-600 font-bold">Rp <span x-text="(item.finalPrice * item.qty).toLocaleString('id-ID')"></span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="$store.cart.updateQty(index, -1)" class="bg-gray-200 px-3 py-1 rounded-lg font-bold hover:bg-gray-300">-</button>
                            <span class="font-bold w-6 text-center" x-text="item.qty"></span>
                            <button @click="$store.cart.updateQty(index, 1)" class="bg-emerald-600 text-white px-3 py-1 rounded-lg font-bold hover:bg-emerald-700">+</button>
                        </div>
                    </div>
                </template>
                <p x-show="$store.cart.items.length === 0" class="text-gray-400 py-4 italic">Keranjang kosong</p>
            </div>
            
            <div x-show="$store.cart.items.length > 0" class="mt-4 pt-4 border-t border-gray-200">
                <p class="font-black text-lg text-gray-800">Total: Rp <span x-text="$store.cart.items.reduce((sum, item) => sum + (item.finalPrice * item.qty), 0).toLocaleString('id-ID')"></span></p>
            </div>

            <div class="flex flex-col gap-2 mt-6">
                <button @click="
                    if (!$store.profile.isComplete) {
                        alert('Mohon lengkapi profil Anda terlebih dahulu!');
                        $store.profile.open = true;
                    } else {
                        let msg = 'Halo, saya ' + $store.profile.nama + ' dari ' + $store.profile.alamat + 
                                  '. Ingin memesan: ' + $store.cart.items.map(i => i.nama + ' (' + i.qty + 'x)').join(', ') + 
                                  '. Kontak: ' + $store.profile.no_hp;
                        window.open('https://wa.me/6281234567890?text=' + encodeURIComponent(msg), '_blank');
                    }
                " class="w-full bg-green-500 text-white py-3 rounded-xl font-bold hover:bg-green-600 transition">
                    Pesan via WhatsApp
                </button>
                <button @click="$store.cart.open = false" class="w-full bg-gray-100 py-3 rounded-xl font-bold hover:bg-gray-200 transition">Lanjut Belanja</button>
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
                if (this.items[index].qty < 1) this.items.splice(index, 1);
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
    });
    </script>
</body>
</html>