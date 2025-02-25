<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['date', 'total', 'costumer_id'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function transactionDetail(): HasMany
    {
        return $this->hasMany(transactionDetail::class, 'transaction_id');
    }
}
