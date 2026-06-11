@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-10">

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <img src="{{ asset('images/belanja_hemat-removebg-preview.png') }}"
             alt="Belanja Hemat"
             class="w-full max-h-[500px] object-contain bg-green-50">

        <div class="p-4 md:p-8">

            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <span>📅 11 Juni 2026</span>
                <span>•</span>
                <span>SembakoKita</span>
            </div>

            <h1 class="text-2xl md:text-4xl font-black text-gray-800 mb-6">
                Tips Belanja Sembako Lebih Hemat untuk Kebutuhan Keluarga
            </h1>

            <div class="space-y-5 text-gray-700 leading-8 text-justify">

                <p>
                   Belanja sembako merupakan aktivitas yang tidak dapat dipisahkan dari kehidupan sehari-hari. 
                   Setiap keluarga membutuhkan berbagai bahan pokok seperti beras, minyak goreng, gula, mie instan, kopi, dan kebutuhan dapur lainnya untuk menunjang aktivitas harian. Namun, tanpa perencanaan yang baik, pengeluaran untuk kebutuhan rumah tangga dapat meningkat secara signifikan setiap bulannya.
                </p>

                <p>
                    Langkah pertama adalah membuat daftar kebutuhan pokok yang benar-benar diperlukan. 
                    Prioritaskan bahan makanan utama seperti beras, gula, minyak goreng, telur, mie instan, dan kebutuhan dapur lainnya. 
                    Dengan menentukan prioritas, risiko pembelian barang yang kurang penting dapat diminimalkan.
                </p>

                <p>
                    Salah satu cara paling efektif untuk menghemat pengeluaran adalah membuat daftar belanja sebelum membeli barang. 
                    Dengan adanya daftar belanja, kita dapat lebih fokus pada kebutuhan yang benar-benar diperlukan dan menghindari pembelian barang yang bersifat impulsif. Banyak orang tanpa sadar membeli produk yang sebenarnya tidak masuk dalam kebutuhan utama hanya karena tertarik dengan kemasan atau promosi tertentu.
                </p>

                <p>
                   Selain membuat daftar belanja, menentukan anggaran juga sangat penting. 
                   Sebelum berbelanja, tentukan jumlah dana yang akan digunakan dan usahakan untuk tidak melebihi batas tersebut. 
                   Dengan cara ini, kondisi keuangan keluarga dapat tetap terjaga dan lebih mudah dikontrol.
                </p>

                <p>
                    Membandingkan harga antar produk juga dapat membantu menghemat pengeluaran. Tidak semua produk dengan harga tinggi memiliki kualitas yang jauh lebih baik. 
                    Banyak produk lokal yang menawarkan kualitas baik dengan harga yang lebih terjangkau. 
                    Oleh karena itu, penting untuk selalu membaca informasi produk dan membandingkan beberapa pilihan sebelum memutuskan membeli.
                </p>

                <p>
                     Memanfaatkan promo dan diskon juga bisa menjadi strategi yang menguntungkan. 
                     Namun, jangan sampai membeli barang hanya karena sedang diskon. 
                     Pastikan barang tersebut memang dibutuhkan sehingga pengeluaran tetap efisien.
                </p>


                 <p>
                     Dengan menerapkan kebiasaan belanja yang terencana dan bijak, kebutuhan rumah tangga dapat terpenuhi dengan baik tanpa harus mengeluarkan biaya yang berlebihan. 
                     Belanja hemat bukan berarti mengurangi kualitas hidup, melainkan mengelola pengeluaran secara lebih cerdas.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection