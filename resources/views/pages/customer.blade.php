<div class="row">
    <!-- Main Content Column (Customer List) -->
    <div class="col-md-8">
        <main>
            <div class="mainlist">
                <div class="maincontrols mb-3">
                    <button class="btn btn-primary" onclick="showCreateMenu(true)">
                        + Buat Pelanggan Baru
                    </button>
                    <!-- Optional search form can be added here -->
                </div>
                <x-customer-list />
            </div>
        </main>
    </div>
    
    <!-- Right Sidebar Column (Side Info) -->
    <div class="col-md-4 right-sidebar">
        <div class="p-3">
            <!-- Create Customer Form -->
            <h2>Pelanggan</h2>
            <hr>
            <div class="createobj" hidden>
                <div class="paddedinfo">
                    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Pelanggan:</label>
                            <input type="text" name="customerName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat:</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telp:</label>
                            <input type="tel" name="telephone" class="form-control" required>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Tambah Pelanggan</button>
                            <button type="button" class="btn btn-secondary" onclick="showCreateMenu(false)">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Customer Information -->
            @if(isset($customer))
            <div class="information">
                <div class="paddedinfo">
                    <p>ID Pelanggan: {{ $customer->id }}</p>
                    <h1>{{ $customer->customerName }}</h1>
                    <hr>
                    <div class="moreinfo">
                        <table class="table table-sm">
                            <tr>
                                <th>Alamat:</th>
                                <td>{{ $customer->address }}</td>
                            </tr>
                            <tr>
                                <th>No. Telp:</th>
                                <td>{{ $customer->telephone }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="d-flex gap-2 flex-wrap">
                    <form id="deleteForm{{ $customer->id }}" action="{{ route('customers.destroy', $customer) }}" method="POST" hidden>
                        @csrf
                        @method('DELETE')
                    </form>
                    <button class="btn btn-info" onclick="showUpdateMenu(true)">Update Pelanggan</button>
                    <button class="btn btn-danger" onclick="deleteProduct({{ $customer->id }})">Hapus Pelanggan</button>
                </div>
            </div>
        </div>
        <!-- Update Customer Form -->
        <div class="infocrud" hidden>
            <div class="paddedinfo">
                <form action="{{ route('customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Pelanggan:</label>
                        <input type="text" name="customerName" value="{{ $customer->customerName }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat:</label>
                        <input type="text" name="address" value="{{ $customer->address }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. Telp:</label>
                        <input type="tel" name="telephone" value="{{ $customer->telephone }}" class="form-control" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Update Pelanggan</button>
                        <button type="button" class="btn btn-secondary" onclick="showUpdateMenu(false)">Batalkan</button>
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
</div>