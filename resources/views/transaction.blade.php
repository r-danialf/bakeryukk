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
        <main>
            <div class="mainlist">
                <div class="maincontrols">
                    <div>
                        <button class="createbtn" onclick="showCreateMenu(true)">
                            + Buat Daftar Transaksi Baru
                        </button>
                    </div>
                    {{-- <div>
                        <form action="{{ route('transaction.index') }}" method="GET">
                            <input type="text" name="search" class="search" placeholder="Cari Pelanggan...">
                            <button class="createbtn">Cari</button>
                        </form>
                    </div> --}}
                </div>

                <x-transaction-list />
            </div>
            <div class="sideinfo">
                <img src="{{ asset('storage/images/menu/receipt.jpg'); }}">
            </div>
        </main>
    </body>
</html>
