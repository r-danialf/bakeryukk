<pre>
=================================
   Struk Nessa Bakery
   Jl.Soekarno No.19 Sukosewu 
      Bojonegoro
=================================
Tanggal    : {{ $transaction->transactionDate }}
ID Transaksi: {{ $transaction->id }}
Pelanggan  : {{ $transaction->customer->customerName }}
Metode     : {{ $transaction->buyingMethod }}
---------------------------------
Item            Qty   Subtotal
---------------------------------
@foreach ($details as $detail)
{{ str_pad($detail->productName, 15) }} {{ str_pad($detail->productQuantity, 5) }} Rp{{ number_format($detail->subTotal, 2, ',', '.') }}
@endforeach
---------------------------------
Total Harga: Rp{{ number_format($transaction->totalPrice, 2, ',', '.') }}
=================================
Terima kasih telah berbelanja!
</pre>
