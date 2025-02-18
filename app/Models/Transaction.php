<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transactionDate',
        'totalPrice',
        'customerId',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId');
    }
}
