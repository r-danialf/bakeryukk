<div class="transactionlist">
    <table>
        <thead>
            <tr>
                <td><i>ID</i></td>
                <td><i>Tanggal</i></td>
                <td><i>Total Harga</i></td>
                <td><i>Pelanggan</i></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr onclick="checkTransaction({{ $transaction->id }})">
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->transactionDate }}</td>
                <td>{{ $transaction->totalPrice }}</td>
                <td>{{ $transaction->customerId }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function checkTransaction(id) {
        window.location.href = `/transaction/${id}`;
    }
</script>
