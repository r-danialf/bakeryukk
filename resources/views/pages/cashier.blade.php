<div class="row">
    <!-- LEFT: Product List -->
    <div class="col-md-3 border-end">
        <div class="c-product-list">
            <!-- You can include your cashier product list component here -->
            <x-cashier-product-list/>
        </div>
    </div>
    <!-- RIGHT: Cashier Section -->
    <div class="col-md-9">
        <div class="c-menu">
            <div class="table-menu">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><b>No.</b></th>
                            <th><b>ID</b></th>
                            <th><b>Nama Produk</b></th>
                            <th><b>Harga Produk</b></th>
                            <th><b>Kuantitas</b></th>
                            <th><b>Total Harga</b></th>
                            <th><b>Aksi</b></th>
                        </tr>
                    </thead>
                    <tbody id="cashier-body">
                        <!-- Cashier items will be rendered here -->
                    </tbody>
                </table>
            </div>
            <form id="transaction-form" method="POST" action="{{ route('transaction.store') }}">
                @csrf
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span>Total: (Rp)</span>
                            <h2 class="d-inline" id="grand-total">0</h2>
                        </div>
                        <div>
                            <span>Kembalian: (Rp)</span>
                            <h2 class="d-inline" id="spare-change">0</h2>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="money" class="form-label">Nominal Uang:</label>
                        <input type="number" name="money" id="money" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="customerId" class="form-label">Nama Pelanggan:</label>
                        <select name="customerId" id="customerId" class="form-select" required>
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
                        <button type="button" class="btn btn-secondary" onclick="cleanCashier()">Bersihkan</button>
                        <button type="submit" class="btn btn-primary">Transaksi</button>
                    </div>
                </div>
                <input type="hidden" name="cart" id="cart-data">
            </form>
        </div>
    </div>
</div>