<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<!-- Row Statistik -->
<div class="row">
    <!-- Total Pelanggan -->
    <div class="col-md-3">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-9">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pelanggan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalCustomers }}
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="fas fa-user fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Produk -->
    <div class="col-md-3">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-9">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Produk
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalProducts }}
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="fas fa-box fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Penjualan -->
    <div class="col-md-3">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-9">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Penjualan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalTransactions }}
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="fas fa-shopping-cart fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Transaksi -->
    <div class="col-md-3">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-9">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Transaksi
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp{{ number_format($totalRevenue, 2) }}
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="fas fa-money-bill-wave fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>