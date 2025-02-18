<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'transactionDate' => 'required|date',
            'totalPrice' => 'required|numeric',
            'customerId' => 'required|exists:customers,id',
        ]);

        Transaction::create([
            'transactionDate' => $request->transactionDate,
            'totalPrice' => $request->totalPrice,
            'customerId' => $request->customerId,
        ]);

        return redirect(url('/transaction'))->with('success', 'Transaksi berhasil dibuat.');
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'transactionDate' => 'required|date',
            'totalPrice' => 'required|numeric',
            'customerId' => 'required|exists:customers,id',
        ]);

        $transaction->update([
            'transactionDate' => $request->transactionDate,
            'totalPrice' => $request->totalPrice,
            'customerId' => $request->customerId,
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil diubah.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect(url('/transaction'))->with('success', 'Transaksi berhasil dihapus.');
    }
}
