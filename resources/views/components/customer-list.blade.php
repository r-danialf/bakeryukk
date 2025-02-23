
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered w-100">
        <thead class="thead-dark">
    <tr>
        <th><i>ID</i></th>
        <th><i>Nama Pembeli</i></th>
        <th><i>Alamat</i></th>
        <th><i>No. Telp</i></th>
    </tr>
</thead>


        <tbody>
            @foreach ($customers as $customer)
            <tr class="listtrans" onclick="checkCustomer({{ $customer->id }})">
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

<style>
        tbody {
            .listtrans:hover {
                background-color: rgba(0, 0, 0, 0.07);
            }
        }
    </style>

</div>
