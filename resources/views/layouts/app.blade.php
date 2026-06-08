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
<body class="bg-gradient-to-br from-green-50 to-emerald-100 min-h-screen">

    <nav class="bg-white shadow-lg border-b border-emerald-100 sticky top-0 z-[500] w-full" x-data>
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-black text-emerald-600 tracking-tight">SEMBAKO<span class="text-gray-800">KITA</span></h1>
            
            <div class="flex items-center gap-4">
                <a href="/" class="font-bold text-gray-700 hover:text-emerald-600">Beranda</a>
                
                <button @click="window.dispatchEvent(new CustomEvent('open-cart'))" 
                        class="flex items-center gap-2 bg-emerald-600 text-white px-4 py-2 rounded-xl font-bold hover:bg-emerald-700 transition">
                    <span>🛒</span> Keranjang
                </button>
            </div>
        </div>
    </nav>

    @yield('content')

</body>
</html>