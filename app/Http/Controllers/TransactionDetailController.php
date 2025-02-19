<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'money' => 'required|numeric|min:0',
            'customerId' => 'required|exists:customers,id',
            'cart' => 'required|array',
        ]);

        $totalPrice = 0;
        foreach ($request->cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        if ($request->money < $totalPrice) {
            return redirect()->back()->with('error', 'Nominal uang kurang!');
        }

        $transaction = Transaction::create([
            'transactionDate' => now(),
            'totalPrice' => $totalPrice,
            'customerId' => $request->customerId,
        ]);

        foreach ($request->cart as $item) {
            TransactionDetail::create([
                'transactionId' => $transaction->id,
                'productId' => $item['id'],
                'productQuantity' => $item['quantity'],
                'subTotal' => $item['price'] * $item['quantity'],
            ]);
        }

        return redirect(url('/transaction'))->with('success', 'Transaksi berhasil dibuat.');
    }

}
