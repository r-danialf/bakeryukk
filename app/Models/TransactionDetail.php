<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{

    protected $fillable = [
        'transactionId',
        'productId',
        'productQuantity',
        'subTotal',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactionId');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
