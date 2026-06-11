@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-10">

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <img src="{{ asset('images/belanja_bulanan-removebg-preview.png') }}"
             alt="Belanja Hemat"
             class="w-full max-h-[500px] object-contain bg-green-50">

        <div class="p-8">

            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <span>📅 11 Juni 2026</span>
                <span>•</span>
                <span>SembakoKita</span>
            </div>

            <h1 class="text-4xl font-black text-gray-800 mb-6">
               Strategi Belanja Bulanan agar Pengeluaran Rumah Tangga Lebih Terkontrol
            </h1>

            <div class="space-y-5 text-gray-700 leading-8 text-justify">

                <p>
                    Mengelola pengeluaran rumah tangga merupakan tantangan yang dihadapi banyak keluarga.
                    Salah satu cara yang dapat dilakukan untuk menjaga kondisi keuangan tetap stabil adalah dengan menerapkan strategi belanja bulanan yang terencana.
                </p>

                <p>
                    Langkah pertama adalah membuat daftar kebutuhan pokok yang benar-benar diperlukan. 
                    Prioritaskan bahan makanan utama seperti beras, gula, minyak goreng, telur, mie instan, dan kebutuhan dapur lainnya. 
                    Dengan menentukan prioritas, risiko pembelian barang yang kurang penting dapat diminimalkan.
                </p>

                <p>
                    Selanjutnya, buat anggaran khusus untuk belanja bulanan. 
                    Menentukan batas pengeluaran sejak awal dapat membantu keluarga mengontrol penggunaan dana dan menghindari pemborosan. 
                    Catatan sederhana mengenai pengeluaran juga sangat membantu untuk mengevaluasi pola belanja setiap bulan.
                </p>

                <p>
                    Membeli produk dalam ukuran yang sesuai kebutuhan juga merupakan strategi yang baik. 
                    Pembelian dalam jumlah besar memang terkadang lebih hemat, tetapi harus disesuaikan dengan kemampuan penyimpanan dan tingkat konsumsi keluarga.
                </p>

                <p>
                    Selain itu, manfaatkan teknologi dan layanan belanja online untuk membandingkan harga produk dengan lebih mudah. 
                    Dengan informasi yang lengkap, konsumen dapat memilih produk terbaik dengan harga yang paling sesuai.
                </p>

                <p>
                    Belanja yang terencana bukan hanya membantu menghemat uang, tetapi juga membuat kebutuhan keluarga selalu tersedia tanpa harus khawatir kekurangan stok. 
                    Dengan pengelolaan yang baik, kondisi keuangan rumah tangga dapat menjadi lebih sehat dan stabil dalam jangka panjang.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection