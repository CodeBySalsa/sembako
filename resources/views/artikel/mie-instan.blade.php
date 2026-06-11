@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-10">

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <img src="{{ asset('images/mie_instant-removebg-preview.png') }}"
             alt="Belanja Hemat"
             class="w-full max-h-[500px] object-contain bg-green-50">

        <div class="p-8">

            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <span>📅 11 Juni 2026</span>
                <span>•</span>
                <span>SembakoKita</span>
            </div>

            <h1 class="text-4xl font-black text-gray-800 mb-6">
               Tips Menyimpan Mie Instan dan Makanan Kemasan dengan Benar
            </h1>

            <div class="space-y-5 text-gray-700 leading-8 text-justify">

                <p>
                   Mie instan dan makanan kemasan merupakan produk yang banyak dipilih karena praktis, mudah disimpan, dan memiliki masa simpan yang cukup panjang. 
                   Produk ini sering dijadikan stok cadangan di rumah untuk memenuhi kebutuhan saat tidak sempat memasak.
                </p>

                <p>
                    Meskipun memiliki daya tahan yang lama, penyimpanan yang kurang tepat dapat memengaruhi kualitas produk. 
                    Oleh karena itu, penting untuk memperhatikan kondisi tempat penyimpanan. 
                    Simpan produk di lokasi yang kering, sejuk, dan tidak terkena sinar matahari langsung.
                </p>

                <p>
                   Paparan panas berlebihan dapat merusak kemasan dan mempercepat penurunan kualitas makanan. 
                   Selain itu, kelembapan yang tinggi juga dapat menyebabkan kemasan menjadi rusak atau isi produk menjadi tidak layak konsumsi.
                </p>

                <p>
                   Penting juga untuk selalu memeriksa tanggal kedaluwarsa sebelum mengonsumsi produk. 
                   Susun stok makanan dengan prinsip "yang lebih lama digunakan terlebih dahulu" agar tidak ada produk yang terbuang karena melewati masa kedaluwarsa.
                </p>

                <p>
                    Jika kemasan sudah dibuka tetapi belum habis digunakan, simpan sisa produk dalam wadah tertutup agar terhindar dari debu dan serangga. 
                    Kebersihan penyimpanan merupakan faktor penting dalam menjaga kualitas makanan.
                </p>

                <p>
                     Dengan penyimpanan yang baik, stok makanan kemasan dapat bertahan lebih lama dan tetap aman untuk dikonsumsi kapan saja.
                </p>


            </div>

        </div>

    </div>

</div>

@endsection