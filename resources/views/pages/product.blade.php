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
            <img class="cropimg information img-fluid mb-3" src="{{ asset('storage/images/products/'.$product->image) }}" alt="Product Image">
            <!-- Product Details -->
            <div class="information mb-3">
                <div class="paddedinfo">
                    <p>ID Produk: {{ $product->id }}</p>
                    <h1>{{ $product->productName }}</h1>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="productsideinfo">
                            <p>Harga:</p>
                            <h2>Rp{{ number_format($product->price, 2, ',', '.') }}</h2>
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
</div>