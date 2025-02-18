<div class="customerlist">
    <table>
        <thead>
            <tr>
                <td><i>ID</i></td>
                <td><i>Nama Pembeli</i></td>
                <td><i>Alamat</i></td>
                <td><i>No. Telp</i></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr onclick="checkCustomer({{ $customer->id }})">
                <td>{{ $customer->id }}</td>
                <td><b>{{ $customer->customerName }}</b></td>
                <td><i>{{ $customer->address }}</i></td>
                <td>{{ $customer->telephone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function checkCustomer(id) {
        window.location.href = `/customer/${id}`;
    }
</script>
