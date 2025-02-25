<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Nessa Bakery</title>
    
    
    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body id="page-top">
    
    <div id="wrapper">
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-birthday-cake"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Nessa Bakery</div>
            </a>
            
            <hr class="sidebar-divider">
            
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="/cashier">
                    <i class="fas fa-cash-register"></i>
                    <span>Kasir</span>
                </a>
            </li>
            
            @if(Auth::check() && Auth::user()->level === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="/product">
                    <i class="fas fa-box"></i>
                    <span>Produk</span>
                </a>
            </li>
            @endif
            
            <li class="nav-item">
                <a class="nav-link" href="/customer">
                    <i class="fas fa-users"></i>
                    <span>Pelanggan</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="/transaction">
                    <i class="fas fa-handshake"></i>
                    <span>Rekap Transaksi</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="/report">
                    <i class="fas fa-file-invoice"></i>
                    <span>Rekap Penjualan</span>
                </a>
            </li>
        </ul>
        
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('sb-admin-2/img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            
            
            <div class="container-fluid">
                @if(Request::is('cashier'))
                    @include('pages.cashier')
                @elseif(Request::is('product*'))
                    @include('pages.product')
                @elseif(Request::is('customer*'))
                    @include('pages.customer')
                @elseif(Request::is('transaction*'))
                    @include('pages.transaction')
                @elseif(Request::is('report'))
                    @include('pages.report')
                @else
                    @include('pages.dashboard')
                @endif
            </div>
        </div>
        
        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const penjualanCtx = document.getElementById('penjualanChart').getContext('2d');
            new Chart(penjualanCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Penjualan',
                        data: [150, 200, 250, 300, 280, 350],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
            
            const pelangganCtx = document.getElementById('pelangganChart').getContext('2d');
            new Chart(pelangganCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Pelanggan Baru',
                        data: [30, 45, 60, 75, 90, 110],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        </script>
    </div>
</div>
</div>

<!-- Toast Notifications -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
    <!-- Toast Success -->
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i> <span id="successMessage">Berhasil!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    
    <!-- Toast Error -->
    <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-times-circle me-2"></i> <span id="errorMessage">Gagal!</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('sb-admin-2/js/sb-admin-2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Toast Script -->
<script>
    // Fungsi untuk menampilkan notifikasi sukses
    function showSuccessToast(message) {
        const successToast = document.getElementById('successToast');
        const successMessage = document.getElementById('successMessage');
        successMessage.textContent = message || 'Berhasil!';
        const toast = new bootstrap.Toast(successToast);
        toast.show();
    }
    
    // Fungsi untuk menampilkan notifikasi gagal
    function showErrorToast(message) {
        const errorToast = document.getElementById('errorToast');
        const errorMessage = document.getElementById('errorMessage');
        errorMessage.textContent = message || 'Gagal!';
        const toast = new bootstrap.Toast(errorToast);
        toast.show();
    }
</script>
</body>
</html>
