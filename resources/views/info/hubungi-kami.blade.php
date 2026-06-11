@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 p-8 text-white text-center">
            <div class="text-5xl mb-3">📞</div>
            <h1 class="text-3xl font-black">Hubungi Kami</h1>
            <p class="text-emerald-100 mt-1">Kami siap melayani Anda</p>
        </div>

        <div class="p-8 space-y-5">

            <div class="flex items-start gap-4 bg-emerald-50 p-5 rounded-2xl">
                <div class="text-2xl">📱</div>
                <div>
                    <p class="font-black text-gray-800 mb-1">No HP / WhatsApp</p>
                    <a href="https://wa.me/6283196633554" target="_blank"
                       class="text-emerald-600 font-bold hover:underline">
                        083196633554
                    </a>
                </div>
            </div>

            <div class="flex items-start gap-4 bg-emerald-50 p-5 rounded-2xl">
                <div class="text-2xl">📍</div>
                <div>
                    <p class="font-black text-gray-800 mb-1">Alamat Toko</p>
                    <p class="text-gray-700">Jl. Brigjend Katamso, Kp. Baru, G. Mesjid,<br>Medan, Sumatera Utara</p>
                </div>
            </div>

            <div class="flex items-start gap-4 bg-emerald-50 p-5 rounded-2xl">
                <div class="text-2xl">✉️</div>
                <div>
                    <p class="font-black text-gray-800 mb-1">Email</p>
                    <a href="mailto:sembakokita22@gmail.com"
                       class="text-emerald-600 font-bold hover:underline">
                        sembakokita22@gmail.com
                    </a>
                </div>
            </div>

            <div class="flex items-start gap-4 bg-emerald-50 p-5 rounded-2xl">
                <div class="text-2xl">🕐</div>
                <div>
                    <p class="font-black text-gray-800 mb-1">Jam Operasional</p>
                    <p class="text-gray-700">Senin – Sabtu</p>
                    <p class="text-emerald-600 font-bold">08.00 – 20.00 WIB</p>
                    <p class="text-sm text-red-500 font-bold mt-1">Minggu: Tutup</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection