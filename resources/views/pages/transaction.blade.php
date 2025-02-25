<div class="row">
    <!-- Main Content Column -->
    <div class="col-md-8">
        <main>
            <div class="mainlist">
                @if(Auth::check() && Auth::user()->level === 'admin')
                <div class="maincontrols mb-3">
                    <button class="btn btn-primary" onclick="showCreateMenu(true)">
                        + Buat Transaksi Baru
                    </button>
                </div>
                @endif
                
                <x-transaction-list />
            </div>
        </main>
    </div>
    
    <!-- Right Sidebar Column -->
    <div class="col-md-4 right-sidebar">
        <!-- You can adjust the content of the side info as needed -->
        <div class="p-3">
            <h2>Transaksi</h2>
            <hr>
            <div class="createobj" hidden>
                <div class="paddedinfo">
                    <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tanggal Transaksi:</label>
                            <input type="date" name="transactionDate" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Harga:</label>
                            <input type="number" name="totalPrice" step="0.01" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pelanggan:</label>
                            <select name="customerId" class="form-select" required>
                                @foreach(App\Models\Customer::all() as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customerName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="buyingMethod" class="form-label">Metode Pembelian:</label>
                            <select name="buyingMethod" id="buyingMethod" class="form-select" required>
                                <option value="Diambil">Diambil</option>
                                <option value="Diantar">Diantar</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Tambah Transaksi</button>
                            <button type="button" class="btn btn-secondary" onclick="showCreateMenu(false)">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
            
            @if(isset($transaction))
            <div class="information">
                <div class="paddedinfo">
                    <p>ID Transaksi: {{ $transaction->id }}</p>
                    <table class="table table-sm">
                        <tr>
                            <th>Tanggal Transaksi:</th>
                            <td>{{ $transaction->transactionDate }}</td>
                        </tr>
                        <tr>
                            <th>Total Harga:</th>
                            <td>Rp{{ number_format($transaction->totalPrice, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Pelanggan:</th>
                            <td>{{ $transaction->customer->customerName }}</td>
                        </tr>
                        <tr>
                            <th>Metode:</th>
                            <td>{{ $transaction->buyingMethod }}</td>
                        </tr>
                    </table>
                </div>
                
                <hr>
                <div class="crudbuttonsect d-flex gap-2 flex-wrap">
                    @if(Auth::check() && Auth::user()->level === 'admin')
                    <form id="deleteForm{{ $transaction->id }}" action="{{ route('transactions.destroy', $transaction) }}" method="POST" hidden>
                        @csrf
                        @method('DELETE')
                    </form>
                    <button class="btn btn-info" onclick="showUpdateMenu(true)">Update Transaksi</button>
                    <button class="btn btn-danger" onclick="deleteProduct({{ $transaction->id }})">Hapus Transaksi</button>
                    @endif
                    <button class="btn btn-warning onreceipt" onclick="showReceiptMenu(true)">Cek Struk</button>
                </div>
                <hr>
                <div class="details-section">
                    <x-transaction-detail-table :transactionId="$transaction->id" />
                </div>
                <div class="receipt-section" hidden>
                    <div class="receipt-content">
                        <x-receipt-transaction :transactionId="$transaction->id" />
                    </div>
                    <div class="crudbuttonsect mt-2">
                        <button class="btn btn-primary" onclick="printReceipt()">Cetak Struk</button>
                    </div>
                </div>
            </div>
            @if(Auth::check() && Auth::user()->level === 'admin')
            <div class="infocrud" hidden>
                <div class="paddedinfo">
                    <form action="{{ route('transactions.update', $transaction) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Tanggal Transaksi:</label>
                            <input type="date" name="transactionDate" value="{{ $transaction->transactionDate }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Harga:</label>
                            <input type="number" name="totalPrice" step="1.00" value="{{ $transaction->totalPrice }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pelanggan:</label>
                            <select name="customerId" class="form-select" required>
                                @foreach(App\Models\Customer::all() as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->customerName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="buyingMethod" class="form-label">Metode Pembelian:</label>
                            <select name="buyingMethod" id="buyingMethod" class="form-select" required>
                                <option value="Diambil">Diambil</option>
                                <option value="Diantar">Diantar</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Update Transaksi</button>
                            <button type="button" class="btn btn-secondary" onclick="showUpdateMenu(false)">Batalkan</button>
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
    </div>
</div>
