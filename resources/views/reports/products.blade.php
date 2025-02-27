<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bakery Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="transactionbody">
    <h1 class="low">Toko Crème n' Crumb</h1>
    <p class="low">Jl. Semangka No. 276B, Kursi Panjang, Surabaya Utara</p>
    <hr>
    <h1>Laporan Produk</h1>
    <table class="reporttable" >
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->productName }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
            </tr>
        @endforeach
    </table>

    <script>window.print();</script>
</body>
</html>
