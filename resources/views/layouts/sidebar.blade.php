<ul class="navbar-nav bg-primarysidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
    <div class="sidebar-brand-icon">
    <i class="fas fa-birthday-cake"></i>
</div>
        <div class="sidebar-brand-text mx-3">Nessa Bakery</div>
    </a>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    @if(auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.produk.index') }}">
                <i class="fas fa-box"></i>
                <span>Produk</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.pelanggan.index') }}">
                <i class="fas fa-users"></i>
                <span>Pelanggan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.transaksi.index') }}">
                <i class="fas fa-handshake"></i>
                <span>Detail Penjualan</span>
            </a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pelanggan.index') }}">
                <i class="fas fa-box"></i>
                <span>Pelanggan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaksi.index') }}">
                <i class="fas fa-users"></i>
                <span>Rekap Transaksi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaksi.index') }}">
                <i class="fas fa-users"></i>
                <span>Rekap Penjualan</span>
            </a>
        </li>
    @endif
</ul>
