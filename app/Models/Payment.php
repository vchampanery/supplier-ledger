<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['bill_number', 'type', 'amount', 'payment_date'];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_number', 'bill_number');
    }
}
