<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'transactionId'   => 'required|exists:transactions,id',
            'productId'       => 'required|exists:products,id',
            'productQuantity' => 'required|integer|min:1',
            'subTotal'        => 'required|numeric|min:0',
        ]);

        TransactionDetail::create([
            'transactionId'   => $request->transactionId,
            'productId'       => $request->productId,
            'productQuantity' => $request->productQuantity,
            'subTotal'        => $request->subTotal,
        ]);

        return redirect(url('/transaction'))->with('success', 'Detail transaksi berhasil dibuat.');
    }

    public function update(Request $request, TransactionDetail $transactionDetail)
    {
        $request->validate([
            'transactionId'   => 'required|exists:transactions,id',
            'productId'       => 'required|exists:products,id',
            'productQuantity' => 'required|integer|min:1',
            'subTotal'        => 'required|numeric|min:0',
        ]);

        $transactionDetail->update([
            'transactionId'   => $request->transactionId,
            'productId'       => $request->productId,
            'productQuantity' => $request->productQuantity,
            'subTotal'        => $request->subTotal,
        ]);

        return redirect()->back()->with('success', 'Detail transaksi berhasil diubah.');
    }

    public function destroy(TransactionDetail $transactionDetail)
    {
        $transactionDetail->delete();
        return redirect(url('/transaction'))->with('success', 'Detail transaksi berhasil dihapus.');
    }
}
