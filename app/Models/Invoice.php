<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'event_id',
        'organization_id',
        'invoice_number',
        'subtotal',
        'discount',
        'tax',
        'total_amount',
        'due_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'due_date' => 'date',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function totalPaid(): float
    {
        return (float) $this->payments()->where('status', 'verified')->sum('amount');
    }

    public function remainingBalance(): float
    {
        return max(0, (float) $this->total_amount - $this->totalPaid());
    }

    public function availableBalance(): float
    {
        if ($this->status === 'cancelled') return 0;
        $pending = (float) $this->payments()->where('status', 'pending_verification')->sum('amount');
        return max(0, $this->remainingBalance() - $pending);
    }
}
