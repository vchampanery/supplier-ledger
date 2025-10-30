<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use carbon\carbon;

class Bill extends Model
{
    protected $primaryKey = 'bill_number';

    // Auto-incrementing is true
    public $incrementing = true;

    // Primary key is an integer
    protected $keyType = 'int';

    protected $fillable = [
        'bill_number', 'supplier_id', 'amount', 'bill_date','due_date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'bill_number', 'bill_number');
    }
    public function totalPayments()
    {
        return $this->payments->where('type', 'payment')->sum('amount');
    }

    public function totalDebitNotes()
    {
        return $this->payments->where('type', 'debit_note')->sum('amount');
    }

    public function pendingAmount()
    {
        return $this->amount - $this->totalPayments() - $this->totalDebitNotes();
    }

    public function isDuePast()
    {
        return $this->due_date && Carbon::parse($this->due_date)->lt(Carbon::today());
    }
    
    public function status()
    {
        $today = Carbon::today();

        
    if ($this->pendingAmount() <= 0) {
        return ['label' => __('messages.status.paid'), 'color' => 'bg-success text-white'];
    }

    if ($this->due_date && Carbon::parse($this->due_date)->lt($today)) {
        return ['label' => __('messages.status.overdue'), 'color' => 'bg-danger text-white'];
    }

    if ($this->due_date && Carbon::parse($this->due_date)->isCurrentMonth()) {
        return ['label' => __('messages.status.due_this_month'), 'color' => 'bg-warning text-dark'];
    }

    if ($this->due_date && Carbon::parse($this->due_date)->gt($today)) {
        return ['label' => __('messages.status.not_due'), 'color' => 'bg-pink text-white'];
    }

    return ['label' => __('messages.status.pending'), 'color' => 'bg-secondary text-white'];
    }
}
