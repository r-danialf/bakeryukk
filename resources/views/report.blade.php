<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bakery Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('components.top-nav')
    <div class="reportpage">
        <h1>Report Page</h1>
        <hr>
        <h2>Laporan Keseluruhan</h2>
        <button onclick="window.location.href='{{ url('/report/customers') }}'">Print Laporan Pelanggan</button> <br>
        <button onclick="window.location.href='{{ url('/report/products') }}'">Print Laporan Produk</button> <br>
        <button onclick="window.location.href='{{ url('/report/transactions') }}'">Print Semua Laporan Transaksi</button>
        <hr>
        <h2>Laporan Khusus</h2>
        <form action="{{ url('/report/transactions/date') }}" method="GET">
            <label for="date">Pilih Tanggal Khusus:</label>
            <input type="date" name="date" required><br>
            <button type="submit">Print Laporan Transaksi </button>
        </form>

    </div>
</body>
</html>
