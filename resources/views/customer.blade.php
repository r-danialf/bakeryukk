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
                            + Buat Pelanggan Baru
                        </button>
                    </div>
                    {{-- <div>
                        <form action="{{ route('customers.index') }}" method="GET">
                            <input type="text" name="search" class="search" placeholder="Cari Pelanggan...">
                            <button class="createbtn">Cari</button>
                        </form>
                    </div> --}}
                </div>

                <x-customer-list />
            </div>
            <div class="sideinfo">
                <img src="{{ asset('storage/images/menu/customer.jpg'); }}">
                <div class="createobj" hidden>
                    <div class="paddedinfo">
                        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label>Nama Pelanggan:</label>
                            <input type="text" name="customerName" required>
                            <label>Alamat:</label>
                            <input type="text" name="address" required>
                            <label>No. Telp:</label>
                            <input type="tel" name="telephone" required>
                            <div class="crudbuttonsect">
                                <button type="submit" class="confirmbtn">Tambah Pelanggan</button>
                                <button class="cancelbtn" onclick="showCreateMenu(false)">Batalkan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if(isset($customer))
                    <div class="information">
                        <div class="paddedinfo">
                            <p>ID Pelanggan: {{ $customer->id }}</p>
                            <h1>{{ $customer->customerName }}</h1>
                            <hr>
                            <div class="moreinfo">
                                <div class="customersideinfo">
                                    <table>
                                        <tr>
                                            <td><b>Alamat:</b></td>
                                            <td>{{ $customer->address }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="customersideinfo">
                                    <table>
                                        <tr>
                                            <td><b>No. Telp: </b></td>
                                            <td>{{ $customer->telephone }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="crudbuttonsect">
                                <form id="deleteForm{{ $customer->id }}" action="{{ route('customers.destroy', $customer) }}" method="POST" hidden>
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <button class="updatebtn" onclick="showUpdateMenu(true)">Update Pelanggan</button>
                                <button class="deletebtn" onclick="deleteProduct({{ $customer->id }})">Hapus Pelanggan</button>
                            </div>
                        </div>
                    </div>
                    <div class="infocrud" hidden>
                        <div class="paddedinfo">
                            <form action="{{ route('customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label>Nama Pelanggan:</label>
                                <input type="text" name="customerName" value="{{ $customer->customerName }}" required>
                                <label>Alamat:</label>
                                <input type="text" name="address" value="{{ $customer->address }}" required>
                                <label>No. Telp:</label>
                                <input type="tel" name="telephone" value="{{ $customer->telephone }}" required>
                                <div class="crudbuttonsect">
                                    <button type="submit" class="updatebtn">Update Pelanggan</button>
                                    <button class="cancelbtn" onclick="showUpdateMenu(false)">Batalkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="information">
                        <div class="paddedinfo">
                            <i>Silahkan pilih pelanggan terlebih dahulu.</i><br>
                            <i>Atau membuat pelanggan baru.</i>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </body>
</html>
