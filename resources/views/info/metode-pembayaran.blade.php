@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 p-8 text-white text-center">
            <div class="text-5xl mb-3">💳</div>
            <h1 class="text-3xl font-black">Metode Pembayaran</h1>
            <p class="text-emerald-100 mt-1">Berbagai pilihan pembayaran tersedia</p>
        </div>

        <div class="p-8 space-y-5">

            {{-- Transfer Bank --}}
            <h2 class="text-lg font-black text-gray-700 flex items-center gap-2">🏦 Transfer Bank</h2>

            <div class="bg-emerald-50 p-5 rounded-2xl">
                <p class="font-black text-gray-800">Bank BCA</p>
                <p class="text-gray-600 text-sm">No. Rekening: <span class="font-bold text-emerald-700">1234567890</span></p>
                <p class="text-gray-600 text-sm">A/N: <span class="font-bold">SembakoKita</span></p>
            </div>

            <div class="bg-emerald-50 p-5 rounded-2xl">
                <p class="font-black text-gray-800">Bank BRI</p>
                <p class="text-gray-600 text-sm">No. Rekening: <span class="font-bold text-emerald-700">0987654321</span></p>
                <p class="text-gray-600 text-sm">A/N: <span class="font-bold">SembakoKita</span></p>
            </div>

            <div class="bg-emerald-50 p-5 rounded-2xl">
                <p class="font-black text-gray-800">Bank Mandiri</p>
                <p class="text-gray-600 text-sm">No. Rekening: <span class="font-bold text-emerald-700">1122334455</span></p>
                <p class="text-gray-600 text-sm">A/N: <span class="font-bold">SembakoKita</span></p>
            </div>

            {{-- Dompet Digital --}}
            <h2 class="text-lg font-black text-gray-700 flex items-center gap-2 pt-2">📲 Dompet Digital</h2>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-emerald-50 p-5 rounded-2xl text-center">
                    <p class="text-2xl mb-1">💚</p>
                    <p class="font-black text-gray-800">GoPay</p>
                    <p class="text-emerald-700 font-bold text-sm">083196633554</p>
                </div>
                <div class="bg-emerald-50 p-5 rounded-2xl text-center">
                    <p class="text-2xl mb-1">🟣</p>
                    <p class="font-black text-gray-800">OVO</p>
                    <p class="text-emerald-700 font-bold text-sm">083196633554</p>
                </div>
                <div class="bg-emerald-50 p-5 rounded-2xl text-center">
                    <p class="text-2xl mb-1">🔵</p>
                    <p class="font-black text-gray-800">Dana</p>
                    <p class="text-emerald-700 font-bold text-sm">083196633554</p>
                </div>
                <div class="bg-emerald-50 p-5 rounded-2xl text-center">
                    <p class="text-2xl mb-1">🟠</p>
                    <p class="font-black text-gray-800">ShopeePay</p>
                    <p class="text-emerald-700 font-bold text-sm">083196633554</p>
                </div>
            </div>

            {{-- QRIS & COD --}}
            <h2 class="text-lg font-black text-gray-700 flex items-center gap-2 pt-2">🔲 Lainnya</h2>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-emerald-50 p-5 rounded-2xl text-center">
                    <p class="text-2xl mb-1">🔲</p>
                    <p class="font-black text-gray-800">QRIS</p>
                    <p class="text-gray-600 text-sm">Scan QR tersedia di toko</p>
                </div>
                <div class="bg-emerald-50 p-5 rounded-2xl text-center">
                    <p class="text-2xl mb-1">💵</p>
                    <p class="font-black text-gray-800">COD</p>
                    <p class="text-gray-600 text-sm">Bayar saat barang tiba</p>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-2xl mt-4">
                <p class="text-yellow-800 text-sm font-bold">⚠️ Setelah transfer, harap konfirmasi pembayaran via WhatsApp ke <span class="text-emerald-600">083196633554</span></p>
            </div>

        </div>
    </div>
</div>
@endsection