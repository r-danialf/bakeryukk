<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\TransactionDetail;
use App\Models\Product;

class TransactionDetailTable extends Component
{
    public $transactionId;
    public $details;

    public function __construct($transactionId)
    {
        $this->transactionId = $transactionId;
        $this->details = TransactionDetail::where('transactionId', $transactionId)
            ->join('products', 'transaction_details.productId', '=', 'products.id')
            ->select('products.productName', 'transaction_details.productQuantity', 'transaction_details.subTotal')
            ->get();
    }

    public function render()
    {
        return view('components.transaction-detail-table');
    }
}
