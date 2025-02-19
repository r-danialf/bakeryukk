<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'money'      => 'required|numeric',
            'customerId' => 'required|exists:customers,id',
            'cart'       => 'required',
        ]);

        // Decode the cart JSON sent from the form
        $cart = json_decode($request->cart, true);
        if (!$cart || count($cart) === 0) {
            return redirect()->back()->withErrors('Cart is empty.');
        }

        // Calculate the total from the cart
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Check if provided money is sufficient
        if ($request->money < $totalPrice) {
            return redirect()->back()->withErrors('Uang tidak mencukupi.');
        }

        // Create the transaction record (using today's date)
        $transaction = Transaction::create([
            'transactionDate' => now()->toDateString(),
            'totalPrice'      => $totalPrice,
            'customerId'      => $request->customerId,
        ]);

        // Create transaction detail records for each cart item
        foreach ($cart as $item) {
            TransactionDetail::create([
                'transactionId'    => $transaction->id,
                'productId'        => $item['id'],
                'productQuantity'  => $item['quantity'],
                'subTotal'         => $item['price'] * $item['quantity'],
            ]);
        }

        return redirect(url('/transaction'))->with('success', 'Transaksi berhasil dibuat.');
    }

    // ... (other methods)
}
