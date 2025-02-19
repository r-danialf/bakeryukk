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
                @if(Auth::check() && Auth::user()->level === 'admin')
                <div class="maincontrols">
                    <div>
                        <button class="createbtn" onclick="showCreateMenu(true)">
                            + Buat Transaksi Baru
                        </button>
                    </div>
                </div>
                @endif

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
                            <div class="moreinfo">
                                <div class="transactionsideinfo">
                                    <table>
                                        <p>ID Transaksi: {{ $transaction->id }}</p>
                                        <br>
                                        <tr>
                                            <td><b>Tanggal Transaksi:</b></td>
                                            <td>{{ $transaction->transactionDate }}</td>
                                        </tr>
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
                            @if(Auth::check() && Auth::user()->level === 'admin')
                            <hr>
                            <div class="crudbuttonsect">
                                <form id="deleteForm{{ $transaction->id }}" action="{{ route('transactions.destroy', $transaction) }}" method="POST" hidden>
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <button class="updatebtn" onclick="showUpdateMenu(true)">Update Transaksi</button>
                                <button class="deletebtn" onclick="deleteProduct({{ $transaction->id }})">Hapus Transaksi</button>
                            </div>
                            @endif
                        </div>
                    </div>
                    @if(Auth::check() && Auth::user()->level === 'admin')
                    <div class="infocrud" hidden>
                        <div class="paddedinfo">
                            <form action="{{ route('transactions.update', $transaction) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label>Tanggal Transaksi:</label>
                                <input type="date" name="transactionDate" value="{{ $transaction->transactionDate }}" required>

                                <label>Total Harga:</label>
                                <input type="number" name="totalPrice" step="1.00" value="{{ $transaction->totalPrice }}" required>

                                <label>Pelanggan:</label>
                                <select name="customerId" required>
                                    @foreach(App\Models\Customer::all() as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->customerName }}</option>
                                    @endforeach
                                </select>

                                <div class="crudbuttonsect">
                                    <button type="submit" class="updatebtn">Update Pelanggan</button>
                                    <button class="cancelbtn" onclick="showUpdateMenu(false)">Batalkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
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

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let input = document.querySelector(".searchable-input");
                let select = document.getElementById("customer-select");
                let optionsDiv = document.getElementById("customer-options");

                function populateOptions() {
                    optionsDiv.innerHTML = "";
                    select.querySelectorAll("option").forEach(option => {
                        let div = document.createElement("div");
                        div.textContent = option.textContent;
                        div.setAttribute("data-value", option.value);
                        div.onclick = function () {
                            input.value = option.textContent;
                            select.value = option.value;
                            optionsDiv.style.display = "none";
                        };
                        optionsDiv.appendChild(div);
                    });
                }

                function filterOptions() {
                    let filter = input.value.toLowerCase();
                    let options = optionsDiv.querySelectorAll("div");
                    let hasResults = false;

                    options.forEach(option => {
                        if (option.textContent.toLowerCase().includes(filter)) {
                            option.style.display = "block";
                            hasResults = true;
                        } else {
                            option.style.display = "none";
                        }
                    });

                    optionsDiv.style.display = hasResults ? "block" : "none";
                }

                input.addEventListener("focus", function () {
                    populateOptions();
                    optionsDiv.style.display = "block";
                });

                document.addEventListener("click", function (e) {
                    if (!e.target.closest(".searchable-select-container")) {
                        optionsDiv.style.display = "none";
                    }
                });

                populateOptions();
            });
        </script>

    </body>
</html>
