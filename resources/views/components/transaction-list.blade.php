<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered w-100">
            <thead class="thead-dark">
                <tr>
                    <th><i>ID</i></th>
                    <th><i>Tanggal</i></th>
                    <th><i>Total Harga</i></th>
                    <th><i>Pelanggan</i></th>
                    <th><i>Metode</i></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr class="listtrans" onclick="checkTransaction({{ $transaction->id }})">
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->transactionDate }}</td>
                    <td>Rp{{ $transaction->totalPrice }}</td>
                    <td>{{ $transaction->customer->customerName }}</td>
                    <td>{{ $transaction->buyingMethod }}</td>
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

    <style>
        tbody {
            .listtrans:hover {
                background-color: rgba(0, 0, 0, 0.07);
            }
        }
    </style>
</div>

