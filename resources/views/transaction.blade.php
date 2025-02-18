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
                            + Buat Transaksi Baru
                        </button>
                    </div>
                </div>

                <x-transaction-list />
            </div>

            <div class="sideinfo">
                <img src="{{ asset('storage/images/menu/receipt.jpg'); }}">
                <div class="createobj" hidden>
                    <div class="paddedinfo">
                        <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label>Tanggal Transaksi:</label>
                            <input type="date" name="transactionDate" required>
                            <label>Total Harga:</label>
                            <input type="number" name="totalPrice" step="0.01" required>
                            <label>Pelanggan:</label>
                            <select name="customerId" required>
                                @foreach(App\Models\Customer::all() as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->customerName }}</option>
                                @endforeach
                            </select>
                            <div class="crudbuttonsect">
                                <button type="submit" class="confirmbtn">Tambah Transaksi</button>
                                <button class="cancelbtn" onclick="showCreateMenu(false)">Batalkan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if(isset($transaction))
                    <div class="information">
                        <div class="paddedinfo">
                            <h1>{{ $transaction->transactionDate }}</h1>
                            <hr>
                            <div class="moreinfo">
                                <div class="transactionsideinfo">
                                    <table>
                                        <tr>
                                            <td><b>Total Harga:</b></td>
                                            <td>{{ $transaction->totalPrice }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Pelanggan:</b></td>
                                            <td>{{ $transaction->customer->customerName }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="crudbuttonsect">
                                <form id="deleteForm{{ $transaction->id }}" action="{{ route('transactions.destroy', $transaction) }}" method="POST" hidden>
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <button class="updatebtn" onclick="showUpdateMenu(true)">Update Transaksi</button>
                                <button class="deletebtn" onclick="deleteProduct({{ $transaction->id }})">Hapus Transaksi</button>
                            </div>
                        </div>
                    </div>
                    <div class="infocrud" hidden>
                        <div class="paddedinfo">
                            <form action="{{ route('transactions.update', $transaction) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label>Tanggal Transaksi:</label>
                                <input type="date" name="transactionDate" value="{{ $transaction->transactionDate }}" required>
                                <label>Total Harga:</label>
                                <input type="number" name="totalPrice" value="{{ $transaction->totalPrice }}" step="0.01" required>
                                <label>Pelanggan:</label>
                                <select name="customerId" required>
                                    @foreach(App\Models\Customer::all() as $customer)
                                        <option value="{{ $customer->id }}" {{ $transaction->customerId == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->customerName }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="crudbuttonsect">
                                    <button type="submit" class="updatebtn">Update Transaksi</button>
                                    <button class="cancelbtn" onclick="showUpdateMenu(false)">Batalkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="information">
                        <div class="paddedinfo">
                            <i>Silahkan pilih transaksi terlebih dahulu.</i><br>
                            <i>Atau membuat transaksi baru.</i>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </body>
</html>
