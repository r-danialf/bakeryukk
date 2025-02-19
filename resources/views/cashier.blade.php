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
        <div class="cashier">
            <div class="c-product-list">
                <x-cashier-product-list />
            </div>
            <div class="c-menu">
                <div class="table-menu">
                    <table>
                        <thead>
                            <tr>
                                <td><b>No.</b></td>
                                <td><b>ID</b></td>
                                <td><b>Nama Produk</b></td>
                                <td><b>Harga Produk</b></td>
                                <td><b>Kuantitas</b></td>
                                <td><b>Total Harga</b></td>
                                <td><b>Aksi</b></td>
                            </tr>
                        </thead>
                        <tbody id="cashier-body">
                        </tbody>
                    </table>
                </div>
                <div class="bottomcashier">
                    <div class="harga">
                        <div class="totalharga">
                            <span>Total: (Rp)</span>
                            <h2><span id="grand-total">0</span></h2>
                        </div>
                        <div class="totalkembalian">
                            <span>Kembalian: (Rp)</span>
                            <h2><span id="spare-change">0</span></h2>
                        </div>
                    </div>
                    <div class="datadiri">
                        <label>Nominal Uang:</label>
                        <input type="number" name="totalPrice" required>
                        <label>Nama Pelanggan:</label>
                        <select name="customerId" required>
                            @foreach(App\Models\Customer::all() as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->customerName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="tombolcashier">
                        <button class="cancelbtn">
                            Bersihkan
                        </button>
                        <button class="confirmbtn">
                            Transaksi
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <script>cart = {};</script>
    </body>
</html>
