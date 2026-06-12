@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6 md:py-12">
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 p-6 md:p-8 text-white text-center">
            <div class="text-4xl md:text-5xl mb-2 md:mb-3">💳</div>
            <h1 class="text-2xl md:text-3xl font-black">Metode Pembayaran</h1>
            <p class="text-emerald-100 mt-1 text-sm md:text-base">Berbagai pilihan pembayaran tersedia</p>
        </div>

        <div class="p-5 md:p-8 space-y-4 md:space-y-5">

            {{-- Transfer Bank --}}
            <h2 class="text-base md:text-lg font-black text-gray-700 flex items-center gap-2">🏦 Transfer Bank</h2>

            <div class="bg-emerald-50 p-4 md:p-5 rounded-2xl">
                <p class="font-black text-gray-800 text-sm md:text-base">Bank BCA</p>
                <p class="text-gray-600 text-xs md:text-sm">No. Rekening: <span class="font-bold text-emerald-700">1234567890</span></p>
                <p class="text-gray-600 text-xs md:text-sm">A/N: <span class="font-bold">SembakoKita</span></p>
            </div>

            <div class="bg-emerald-50 p-4 md:p-5 rounded-2xl">
                <p class="font-black text-gray-800 text-sm md:text-base">Bank BRI</p>
                <p class="text-gray-600 text-xs md:text-sm">No. Rekening: <span class="font-bold text-emerald-700">0987654321</span></p>
                <p class="text-gray-600 text-xs md:text-sm">A/N: <span class="font-bold">SembakoKita</span></p>
            </div>

            <div class="bg-emerald-50 p-4 md:p-5 rounded-2xl">
                <p class="font-black text-gray-800 text-sm md:text-base">Bank Mandiri</p>
                <p class="text-gray-600 text-xs md:text-sm">No. Rekening: <span class="font-bold text-emerald-700">1122334455</span></p>
                <p class="text-gray-600 text-xs md:text-sm">A/N: <span class="font-bold">SembakoKita</span></p>
            </div>

            {{-- Dompet Digital --}}
            <h2 class="text-base md:text-lg font-black text-gray-700 flex items-center gap-2 pt-2">📲 Dompet Digital</h2>

            <div class="grid grid-cols-2 gap-3 md:gap-4">
                <div class="bg-emerald-50 p-3 md:p-5 rounded-2xl text-center">
                    <p class="text-xl md:text-2xl mb-1">💚</p>
                    <p class="font-black text-gray-800 text-sm md:text-base">GoPay</p>
                    <p class="text-emerald-700 font-bold text-xs md:text-sm">083196633554</p>
                </div>
                <div class="bg-emerald-50 p-3 md:p-5 rounded-2xl text-center">
                    <p class="text-xl md:text-2xl mb-1">🟣</p>
                    <p class="font-black text-gray-800 text-sm md:text-base">OVO</p>
                    <p class="text-emerald-700 font-bold text-xs md:text-sm">083196633554</p>
                </div>
                <div class="bg-emerald-50 p-3 md:p-5 rounded-2xl text-center">
                    <p class="text-xl md:text-2xl mb-1">🔵</p>
                    <p class="font-black text-gray-800 text-sm md:text-base">Dana</p>
                    <p class="text-emerald-700 font-bold text-xs md:text-sm">083196633554</p>
                </div>
                <div class="bg-emerald-50 p-3 md:p-5 rounded-2xl text-center">
                    <p class="text-xl md:text-2xl mb-1">🟠</p>
                    <p class="font-black text-gray-800 text-sm md:text-base">ShopeePay</p>
                    <p class="text-emerald-700 font-bold text-xs md:text-sm">083196633554</p>
                </div>
            </div>

            {{-- QRIS & COD --}}
            <h2 class="text-base md:text-lg font-black text-gray-700 flex items-center gap-2 pt-2">🔲 Lainnya</h2>

            <div class="grid grid-cols-2 gap-3 md:gap-4">
                <div class="bg-emerald-50 p-3 md:p-5 rounded-2xl text-center">
                    <p class="text-xl md:text-2xl mb-1">🔲</p>
                    <p class="font-black text-gray-800 text-sm md:text-base">QRIS</p>
                    <p class="text-gray-600 text-xs md:text-sm">Scan QR tersedia di toko</p>
                </div>
                <div class="bg-emerald-50 p-3 md:p-5 rounded-2xl text-center">
                    <p class="text-xl md:text-2xl mb-1">💵</p>
                    <p class="font-black text-gray-800 text-sm md:text-base">COD</p>
                    <p class="text-gray-600 text-xs md:text-sm">Bayar saat barang tiba</p>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 p-3 md:p-4 rounded-2xl mt-2 md:mt-4">
                <p class="text-yellow-800 text-xs md:text-sm font-bold">⚠️ Setelah transfer, harap konfirmasi pembayaran via WhatsApp ke <span class="text-emerald-600">083196633554</span></p>
            </div>

        </div>
    </div>
</div>
@endsection