@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-6 md:py-12">
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 p-6 md:p-8 text-white text-center">
            <div class="text-4xl md:text-5xl mb-2 md:mb-3">📞</div>
            <h1 class="text-2xl md:text-3xl font-black">Hubungi Kami</h1>
            <p class="text-emerald-100 mt-1 text-sm md:text-base">Kami siap melayani Anda</p>
        </div>

        <div class="p-5 md:p-8 space-y-4 md:space-y-5">

            <div class="flex items-start gap-4 bg-emerald-50 p-4 md:p-5 rounded-2xl">
                <div class="text-xl md:text-2xl flex-shrink-0">📱</div>
                <div>
                    <p class="font-black text-gray-800 mb-1 text-sm md:text-base">No HP / WhatsApp</p>
                    <a href="https://wa.me/6283196633554" target="_blank"
                       class="text-emerald-600 font-bold hover:underline text-sm md:text-base">
                        083196633554
                    </a>
                </div>
            </div>

            <div class="flex items-start gap-4 bg-emerald-50 p-4 md:p-5 rounded-2xl">
                <div class="text-xl md:text-2xl flex-shrink-0">📍</div>
                <div>
                    <p class="font-black text-gray-800 mb-1 text-sm md:text-base">Alamat Toko</p>
                    <p class="text-gray-700 text-sm md:text-base">Jl. Brigjend Katamso, Kp. Baru, G. Mesjid,<br>Medan, Sumatera Utara</p>
                </div>
            </div>

            <div class="flex items-start gap-4 bg-emerald-50 p-4 md:p-5 rounded-2xl">
                <div class="text-xl md:text-2xl flex-shrink-0">✉️</div>
                <div>
                    <p class="font-black text-gray-800 mb-1 text-sm md:text-base">Email</p>
                    <a href="mailto:sembakokita22@gmail.com"
                       class="text-emerald-600 font-bold hover:underline text-sm md:text-base break-all">
                        sembakokita22@gmail.com
                    </a>
                </div>
            </div>

            <div class="flex items-start gap-4 bg-emerald-50 p-4 md:p-5 rounded-2xl">
                <div class="text-xl md:text-2xl flex-shrink-0">🕐</div>
                <div>
                    <p class="font-black text-gray-800 mb-1 text-sm md:text-base">Jam Operasional</p>
                    <p class="text-gray-700 text-sm md:text-base">Senin – Sabtu</p>
                    <p class="text-emerald-600 font-bold text-sm md:text-base">08.00 – 20.00 WIB</p>
                    <p class="text-xs md:text-sm text-red-500 font-bold mt-1">Minggu: Tutup</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection