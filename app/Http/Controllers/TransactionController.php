<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'money'        => 'required|numeric',
            'customerId'   => 'required|exists:customers,id',
            'buyingMethod' => 'required|in:Diambil,Diantar', // <-- Validate buyingMethod
            'cart'         => 'required',
        ]);

        $cart = json_decode($request->cart, true);
        if (!$cart || count($cart) === 0) {
            return redirect()->back()->withErrors('Cart is empty.');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        if ($request->money < $totalPrice) {
            return redirect()->back()->withErrors('Uang tidak mencukupi.');
        }

        DB::transaction(function() use ($request, $cart, $totalPrice) {
            $transaction = Transaction::create([
                'transactionDate' => now()->toDateString(),
                'totalPrice'      => $totalPrice,
                'buyingMethod'    => $request->buyingMethod, // <-- Include buyingMethod
                'customerId'      => $request->customerId,
            ]);

            foreach ($cart as $item) {
                $product = Product::findOrFail($item['id']);

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Not enough stock for product ID: {$product->id}");
                }

                $product->stock -= $item['quantity'];
                $product->save();

                TransactionDetail::create([
                    'transactionId'   => $transaction->id,
                    'productId'       => $item['id'],
                    'productQuantity' => $item['quantity'],
                    'subTotal'        => $item['price'] * $item['quantity'],
                ]);
            }
        });

        return redirect(url('/transaction'))->with('success', 'Transaksi berhasil dibuat.');
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'transactionDate' => 'required|date',
            'totalPrice'      => 'required|numeric',
            'buyingMethod'    => 'required|in:Diambil,Diantar', // <-- Validate buyingMethod
            'customerId'      => 'required|exists:customers,id',
        ]);

        $transaction->update([
            'transactionDate' => $request->transactionDate,
            'totalPrice'      => $request->totalPrice,
            'buyingMethod'    => $request->buyingMethod, // <-- Include buyingMethod
            'customerId'      => $request->customerId,
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil diubah.');
    }
}
