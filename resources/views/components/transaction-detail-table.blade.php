<div class="detailtransactionlist">
    <table>
        <thead>
            <tr>
                <td>Nama Produk</td>
                <td>Kuantitas</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->productName }}</td>
                    <td>{{ $detail->productQuantity }}</td>
                    <td>{{ number_format($detail->subTotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
