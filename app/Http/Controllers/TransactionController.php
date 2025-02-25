<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\TransactionDetail;

use App\Http\Controllers\TransactionDetailController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    # Store: Data Transaksi
    public function store(Request $request)
    {
        $request->validate([
            'date'          => 'required|date',
            'total'         => 'required|numeric',
            'customer_id'   => 'required|exists:customers,id'
        ]);

        Transaction::create([
            'date'          => $request->date,
            'total'         => $request->total,
            'customer_id'   => $request->customer
        ]);

        return redirect(url('/transaction'))->with('success', 'Berhasil.');
    }

    # Buy: Melakukan Transaksi Kasir
    public function buy(Request $request) {
        $request->validate([
            'money'       => 'required|numeric|min:0',
            'customer_id' => 'required|exists:customers,id',
            'cart'        => 'required'
        ]);

        $cart = json_decode($request->cart, true);
        if (!$cart || count($cart) === 0) {
            return redirect()->back()->withErrors('Keranjang kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($request->money < $total) {
            return redirect()->back()->withErrors('Uang tidak cukup.');
        }

        DB::transaction(function() use ($request, $cart, $total) {
            $transaction = $this->store( new Request([
                'date'        => now()->toDateString(),
                'total'       => $total,
                'customer_id' => $request->customer_id
            ]));

            foreach ($cart as $item) {
                $product = Product::findOrFail($item['id']);

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok tidak cukup.");
                }

                $product->stock -= $item['quantity'];
                $product->save();

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id'     => $item['id'],
                    'quantity'       => $item['quantity'],
                    'subtotal'       => $item['price'] * $item['quantity']
                ]);
            }
        });

        return redirect(url('/transaction'))->with('success', 'Berhasil.');
    }

    # Update: Data Transaksi
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'date'        => 'required|date',
            'total'       => 'required|numeric|min:0',
            'customer_id' => 'required|exists:customers,id'
        ]);

        $transaction->update([
            'date'        => $request->date,
            'total'       => $request->total,
            'customer_id' => $request->customer
        ]);

        return redirect()->back()->with('success', 'Berhasil.');
    }

    # Destroy: Data Transaksi
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect(url('/transaction'))->with('success', 'Berhasil.');
    }
}
