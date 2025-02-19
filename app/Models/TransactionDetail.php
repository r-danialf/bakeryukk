<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transactionId',
        'productId',
        'productQuantity',
        'subTotal',
    ];

    /**
     * Get the transaction that owns this detail.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactionId');
    }

    /**
     * Get the product associated with this detail.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
