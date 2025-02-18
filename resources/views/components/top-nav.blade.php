<nav class="topnav">
    <div>
        <div class="tn-title">BakeryLaravel</div>
        <div class="tn-separator"></div>
        <div class="tn-navlink">
            <ul>
                <li><a href="/"
                    @if(request()->is('/')) chosen @endif>Dashboard</a></li>
                <li><a href="/cashier"
                    @if(request()->is('cashier')) chosen @endif>Kasir</a></li>
                <li><a href="/customer"
                    @if(request()->is('customer') || request()->is('customer/*')) chosen @endif>Pelanggan</a></li>
                <li><a href="/product"
                    @if(request()->is('product') || request()->is('product/*')) chosen @endif>Produk</a></li>
                <li><a href="/transaction"
                    @if(request()->is('transaction') || request()->is('transaction/*')) chosen @endif>Transaksi</a></li>
            </ul>
        </div>
    </div>
    <div class="tn-navlink">
        <ul>
            <li><a>User Name</a></li>
        </ul>
    </div>
</nav>
