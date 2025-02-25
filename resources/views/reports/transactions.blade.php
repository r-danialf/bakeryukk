<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bakery Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="transactionbody">
    <h1 class="low">Nessa Bakery</h1>
    <p class="low">Jl.Soekarno No.19 Sukosewu, Bojonegoro</p>
    <hr>
    <h1>Laporan Transaksi</h1>
    <table class="reporttable">
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Total Harga</th>
            <th>Nama Pelanggan</th>
            <th>Pesanan</th>
        </tr>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->transactionDate }}</td>
                <td>Rp{{number_format($transaction->totalPrice, 2, ',', '.') }}</td>
                <td>{{ $transaction->customer->customerName }}</td>
                <td>
                    <table class="reporttable" >
                        <tr>
                            <th>Nama Produk</th>
                            <th>Kuantitas</th>
                            <th>Subtotal</th>
                        </tr>
                        @foreach ($transaction->transactionDetails as $detail)
                            <tr>
                                <td>{{ $detail->product->productName }}</td>
                                <td>{{ $detail->productQuantity }}</td>
                                <td>Rp{{number_format($detail->subTotal, 2, ',', '.')  }}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        @endforeach
    </table>

    <script>window.print();</script>
</body>
</html>
