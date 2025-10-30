<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['supplier_name', 'city_id', 'credit_days', 'status'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
