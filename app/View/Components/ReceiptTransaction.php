<?php

namespace App\View\Components;

use Closure;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReceiptTransaction extends Component
{
    public $transactionID;
    public $details;
    public $transaction;

    public function __construct($transactionId)
    {
        $this->transactionId = $transactionId;
        $this->details = TransactionDetail::where('transactionId', $transactionId)
            ->join('products', 'transaction_details.productId', '=', 'products.id')
            ->select('products.productName', 'transaction_details.productQuantity', 'transaction_details.subTotal')
            ->get();
        $this->transaction = Transaction::find($transactionId);
    }

    public function render(): View|Closure|string
    {
        return view('components.receipt-transaction');
    }
}
