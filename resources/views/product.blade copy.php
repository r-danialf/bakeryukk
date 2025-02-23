<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Bakery Dashboard</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('components.top-nav')
        <main>
            <div class="mainlist">
                <div class="maincontrols">
                    <div>
                        <button class="createbtn" onclick="showCreateMenu(true)">
                            + Buat Produk Baru
                        </button>
                    </div>
                    {{-- <div>
                        <input type="text" name="search" class="search" placeholder="Cari Produk...">
                        <button type="submit" class="createbtn">Cari</button>
                    </div> --}}
                </div>

                <x-product-list />
            </div>
            <div class="sideinfo">
                <img class="createobj" src="{{ asset('storage/images/menu/bakery.png') }}" hidden>
                <div class="createobj" hidden>
                    <div class="paddedinfo">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label>Nama Produk:</label>
                            <input type="text" name="productName" required>
                            <label>Harga:</label>
                            <input type="number" name="price" required>
                            <label>Stok:</label>
                            <input type="number" name="stock" required>
                            <label>Gambar Produk:</label>
                            <input type="file" name="image" required>
                            <div class="crudbuttonsect">
                                <button type="submit" class="confirmbtn">Tambah Produk</button>
                                <button class="cancelbtn" onclick="showCreateMenu(false)">Batalkan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if(isset($product))
                    <img class="information" src="{{ asset('storage/images/products/'.$product->image) }}">
                    <div class="information">
                        <div class="paddedinfo">
                            <p>ID Produk: {{ $product->id }}</p>
                            <h1>{{ $product->productName }}</h1>
                            <hr>
                            <div class="moreinfo-flex">
                                <div class="productsideinfo">
                                    <p>Harga: </p>
                                    <h2>Rp{{ $product->price }}</h2>
                                </div>
                                <div class="productsideinfo">
                                    <p>Stok: </p>
                                    <h2>{{ $product->stock }}x</h2>
                                </div>
                            </div>
                            <hr>
                            <div class="crudbuttonsect">
                                <form id="deleteForm{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST" hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <button class="updatebtn" onclick="showUpdateMenu(true)">Update Produk</button>
                                <button class="deletebtn" onclick="deleteProduct({{ $product->id }})">Hapus Produk</button>
                            </div>
                        </div>
                    </div>
                    <img class="infocrud" src="{{ asset('storage/images/menu/bakery.png') }}" hidden>
                    <div class="infocrud" hidden>
                        <div class="paddedinfo">
                            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label>Nama Produk:</label>
                                <input type="text" name="productName" value="{{ $product->productName }}" required><br>
                                <label>Harga:</label>
                                <input type="number" name="price" value="{{ $product->price }}" required><br>
                                <label>Stok:</label>
                                <input type="number" name="stock" value="{{ $product->stock }}" required><br>
                                <label>Gambar Produk:</label>
                                <img src="{{ asset('storage/images/products/'.$product->image) }}" width="100"><br>
                                <label>Gambar Baru Produk:</label>
                                <input type="file" name="image"><br>
                                <div class="crudbuttonsect">
                                    <button type="submit" class="updatebtn">Update Produk</button>
                                    <button class="cancelbtn" onclick="showUpdateMenu(false)">Batalkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <img class="information" src="{{ asset('storage/images/menu/bakery.png') }}">
                    <div class="information">
                        <div class="paddedinfo">
                            <i>Silahkan pilih produk terlebih dahulu.</i><br>
                            <i>Atau membuat produk baru.</i>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </body>
</html>
