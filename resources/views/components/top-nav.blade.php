<nav class="topnav">
    <div>
        <img src="{{ asset('storage/images/menu/bun.webp') }}" alt="">
        <div class="tn-title">Felia Bakery</div>
        <div class="tn-separator"></div>
        <div class="tn-navlink">
            <ul>
                <li><a href="/dashboard"
                    @if(request()->is('dashboard')) chosen @endif>Dashboard</a></li>
                <li><a href="/cashier"
                    @if(request()->is('cashier')) chosen @endif>Kasir</a></li>
                <li><a href="/customer"
                    @if(request()->is('customer') || request()->is('customer/*')) chosen @endif>Pelanggan</a></li>
                @if(Auth::check() && Auth::user()->level === 'admin')
                    <li><a href="/product"
                        @if(request()->is('product') || request()->is('product/*')) chosen @endif>Produk</a></li>
                @endif
                <li><a href="/transaction"
                    @if(request()->is('transaction') || request()->is('transaction/*')) chosen @endif>Transaksi</a></li>
                @if(Auth::check() && Auth::user()->level === 'admin')
                    <li><a href="/report"
                        @if(request()->is('report')) chosen @endif>Laporan</a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="tn-navlink">
        <ul>
            <li><p>{{ Auth::user()->name ?? 'Guest' }}</p></li>
        </ul>
        <div class="tn-separator"></div>
        <ul>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    LOG OUT
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>
</nav>
