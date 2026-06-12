@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-10">

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <img src="{{ asset('images/minyak_goreng-removebg-preview.png') }}"
             alt="Belanja Hemat"
             class="w-full max-h-[500px] object-contain bg-green-50">

       <div class="p-4 md:p-8">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <span>📅 11 Juni 2026</span>
                <span>•</span>
                <span>SembakoKita</span>
            </div>

           <h1 class="text-2xl md:text-4xl font-black text-gray-800 mb-6">
               Mengenal Jenis-Jenis Minyak Goreng yang Sering Digunakan
            </h1>

            <div class="space-y-5 text-gray-700 leading-8 text-justify">

                <p>
                   Minyak goreng merupakan salah satu bahan dapur yang hampir selalu digunakan dalam berbagai jenis masakan. 
                   Saat ini tersedia beragam jenis minyak goreng dengan karakteristik dan keunggulan masing-masing. 
                   Memahami perbedaannya dapat membantu kita memilih minyak yang sesuai dengan kebutuhan memasak sehari-hari.
                </p>

                <p>
                    Minyak sawit merupakan jenis minyak yang paling banyak digunakan di Indonesia. 
                    Harganya relatif terjangkau dan mudah ditemukan di berbagai toko maupun supermarket. 
                    Minyak ini cocok digunakan untuk menggoreng, menumis, dan berbagai kebutuhan memasak lainnya.
                </p>

                <p>
                   Selain minyak sawit, terdapat minyak kelapa yang sering digunakan dalam masakan tradisional. 
                   Minyak kelapa memiliki aroma khas yang dapat menambah cita rasa makanan tertentu. 
                   Beberapa masyarakat juga menganggap minyak kelapa sebagai pilihan yang lebih alami.
                </p>

                <p>
                   Jenis lainnya adalah minyak jagung yang memiliki kandungan lemak tak jenuh cukup tinggi. 
                   Minyak ini sering digunakan untuk memasak makanan sehat karena memiliki rasa yang lebih ringan dan tidak terlalu memengaruhi cita rasa makanan.
                </p>

                <p>
                    Sementara itu, minyak zaitun lebih populer digunakan untuk salad, memanggang, atau masakan tertentu yang tidak membutuhkan suhu terlalu tinggi. 
                    Meskipun harganya lebih mahal, minyak zaitun dikenal memiliki berbagai manfaat bagi kesehatan.
                </p>

                <p>
                     Dalam penggunaannya, penting untuk tidak menggunakan minyak goreng secara berulang kali terlalu banyak. 
                     Minyak yang digunakan berkali-kali dapat mengalami penurunan kualitas dan memengaruhi rasa serta keamanan makanan.
                </p>

                 <p>
                    Dengan memahami jenis-jenis minyak goreng yang tersedia, masyarakat dapat memilih produk yang sesuai dengan kebutuhan dan gaya hidup masing-masing.
                </p>



            </div>

        </div>

    </div>

</div>

@endsection