<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Felia Bakery</title>
  <!-- Custom fonts for this template -->
  <link href="{{ asset('sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <style>
    /* Optional custom style for the right sidebar */
    .right-sidebar {
      background-color: #f8f9fc;
      border-left: 1px solid #e3e6f0;
      min-height: 100vh;
      /* If you wish for a fixed right sidebar, consider adding position: sticky; top: 0; */
    }
    /* Ensure left sidebar takes full height */
    #accordionSidebar {
      min-height: 100vh;
    }

    .cropimg {
            width: 100%;
            height: 20vh;
            object-fit: cover;
        }
  </style>

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


    <!-- Main Content & Right Sidebar Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column flex-grow-1">
      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
              <span class="me-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
              <img class="img-profile rounded-circle" src="{{ asset('sb-admin-2/img/undraw_profile.svg') }}">
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </nav>

      <!-- Page Content -->
      <div class="container-fluid">
        <div class="row">
          <!-- Main Content Column (Product List) -->
          <div class="col-md-8">
            <main>
              <div class="mainlist">
                <div class="maincontrols mb-3">
                  <button class="btn btn-primary" onclick="showCreateMenu(true)">
                    + Buat Produk Baru
                  </button>
                  <!-- Optional search field could be placed here -->
                </div>
                <x-product-list />
              </div>
            </main>
          </div>

          <!-- Right Sidebar Column (Side Info) -->
          <div class="col-md-4 right-sidebar">
            <div class="p-3">
              <!-- Create Product Form -->
              <div class="createobj" hidden>
                <div class="paddedinfo">
                  <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label class="form-label">Nama Produk:</label>
                      <input type="text" name="productName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Harga:</label>
                      <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Stok:</label>
                      <input type="number" name="stock" class="form-control" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Gambar Produk:</label>
                      <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="d-flex gap-2">
                      <button type="submit" class="btn btn-success">Tambah Produk</button>
                      <button type="button" class="btn btn-secondary" onclick="showCreateMenu(false)">Batalkan</button>
                    </div>
                  </form>
                </div>
              </div>

              @if(isset($product))
              <!-- Display Product Image -->
              <img class="cropimg img-fluid mb-3" src="{{ asset('storage/images/products/'.$product->image) }}" alt="Product Image">
              <!-- Product Details -->
              <div class="information mb-3">
                <div class="paddedinfo">
                  <p>ID Produk: {{ $product->id }}</p>
                  <h1>{{ $product->productName }}</h1>
                  <hr>
                  <div class="d-flex justify-content-between">
                    <div class="productsideinfo">
                      <p>Harga:</p>
                      <h2>Rp{{ $product->price }}</h2>
                    </div>
                    <div class="productsideinfo">
                      <p>Stok:</p>
                      <h2>{{ $product->stock }}x</h2>
                    </div>
                  </div>
                  <hr>
                  <div class="d-flex gap-2 flex-wrap">
                    <form id="deleteForm{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST" hidden>
                      @csrf
                      @method('DELETE')
                    </form>
                    <button class="btn btn-info" onclick="showUpdateMenu(true)">Update Produk</button>
                    <button class="btn btn-danger" onclick="deleteProduct({{ $product->id }})">Hapus Produk</button>
                  </div>
                </div>
              </div>

              <!-- Update Product Form -->
              <div class="infocrud" hidden>
                <div class="paddedinfo">
                  <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label class="form-label">Nama Produk:</label>
                      <input type="text" name="productName" value="{{ $product->productName }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Harga:</label>
                      <input type="number" name="price" value="{{ $product->price }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Stok:</label>
                      <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Gambar Produk:</label>
                      <img src="{{ asset('storage/images/products/'.$product->image) }}" width="100" class="d-block mb-2">
                      <label class="form-label">Gambar Baru Produk:</label>
                      <input type="file" name="image" class="form-control">
                    </div>
                    <div class="d-flex gap-2">
                      <button type="submit" class="btn btn-success">Update Produk</button>
                      <button type="button" class="btn btn-secondary" onclick="showUpdateMenu(false)">Batalkan</button>
                    </div>
                  </form>
                </div>
              </div>
              @else
              <div class="information">
                <div class="paddedinfo">
                  <i>Silahkan pilih produk terlebih dahulu.</i><br>
                  <i>Atau membuat produk baru.</i>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /#content-wrapper -->
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
