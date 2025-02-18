<?php

namespace App\View\Components;

use Closure;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TransactionList extends Component
{

    public $transactions;

    public function __construct()
    {
        $this->transactions = Transaction::all();
    }

    public function render(): View|Closure|string
    {
        return view('components.transaction-list', [
            'transactions' => $this->transactions
        ]);
    }

    public function showTransaction()
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }

        return view('transaction.show', compact('transaction'));
    }
}
