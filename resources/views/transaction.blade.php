<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Felia Bakery</title>


    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body id="page-top">

    <div id="wrapper">
    <ul class="navbar-nav bg-warning sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
    <div class="sidebar-brand-icon">
    <i class="fas fa-birthday-cake"></i>
</div>
        <div class="sidebar-brand-text mx-3">Felia Bakery</div>
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
                <span>Transaksi</span>
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
      <!-- Content Row -->
      <div class="container-fluid">
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
                      <td>{{ $transaction->totalPrice }}</td>
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
                @if(Auth::check() && Auth::user()->level === 'admin')
                <hr>
                <div class="crudbuttonsect d-flex gap-2 flex-wrap">
                  <form id="deleteForm{{ $transaction->id }}" action="{{ route('transactions.destroy', $transaction) }}" method="POST" hidden>
                    @csrf
                    @method('DELETE')
                  </form>
                  <button class="btn btn-info" onclick="showUpdateMenu(true)">Update Transaksi</button>
                  <button class="btn btn-danger" onclick="deleteProduct({{ $transaction->id }})">Hapus Transaksi</button>
                  <button class="btn btn-warning onreceipt" onclick="showReceiptMenu(true)">Cek Struk</button>
                </div>
                @endif
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
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.flex-column -->
  </div><!-- /#wrapper -->

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
