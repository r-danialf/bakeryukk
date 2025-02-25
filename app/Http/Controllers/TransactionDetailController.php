<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    # Store: Data Detail Transaksi
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'product_id'     => 'required|exists:products,id',
            'quantity'       => 'required|integer|min:1',
            'subtotal'       => 'required|numeric|min:0'
        ]);

        TransactionDetail::create([
            'transaction_id' => $request->transaction_id,
            'product_id'     => $request->product_id,
            'quantity'       => $request->quantity,
            'subtotal'       => $request->subtotal
        ]);

        return redirect(url('/transaction'))->with('success', 'Berhasil.');
    }

    # Update: Data Detail Transaksi
    public function update(Request $request, TransactionDetail $transactionDetail)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'product_id'     => 'required|exists:products,id',
            'quantity'       => 'required|integer|min:1',
            'subtotal'       => 'required|numeric|min:0'
        ]);

        $transactionDetail->update([
            'transaction_id' => $request->transaction_id,
            'product_id'     => $request->product_id,
            'quantity'       => $request->quantity,
            'subtotal'       => $request->subtotal
        ]);

        return redirect()->back()->with('success', 'Berhasil.');
    }

    # Destroy: Data Detail Transaksi
    public function destroy(TransactionDetail $transactionDetail)
    {
        $transactionDetail->delete();
        return redirect(url('/transaction'))->with('success', 'Berhasil.');
    }
}
