<div class="container mt-5">
    <h1 class="text-center">Report Page</h1>
    <hr>
    
    <h2>Laporan Keseluruhan</h2>
    
    <div class="mb-3">
        <button onclick="window.location.href='{{ url('/report/customers') }}'" class="btn btn-primary">Print Laporan Pelanggan</button>
    </div>
    <div class="mb-3">
        <button onclick="window.location.href='{{ url('/report/products') }}'" class="btn btn-primary">Print Laporan Produk</button>
    </div>
    <div class="mb-3">
        <button onclick="window.location.href='{{ url('/report/transactions') }}'" class="btn btn-primary">Print Semua Laporan Transaksi</button>
    </div>
    
    <hr>
    
    <h2>Laporan Khusus</h2>
    
    <form action="{{ url('/report/transactions/date') }}" method="GET" class="mb-4">
        <div class="form-group">
            <label for="date">Pilih Tanggal Khusus:</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Print Laporan Transaksi</button>
    </form>
    
</div>