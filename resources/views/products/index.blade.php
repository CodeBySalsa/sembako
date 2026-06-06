<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk Sembako</title>
</head>
<body>
    <h1>Daftar Produk Sembako</h1>
    <table border="1">
        <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->nama_produk }}</td>
            <td>Rp {{ number_format($product->harga) }}</td>
            <td>{{ $product->stok }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>