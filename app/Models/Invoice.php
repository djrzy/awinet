<?php

namespace App\Models;

use App\Enums\Invoice\BillingGenerationType;
use App\Enums\Invoice\InvoiceStatus;
use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory, BelongsToTenant;

    protected $fillable = [
        'uuid',
        'tenant_id',
        'customer_id',
        'service_id',
        'billing_period',
        'billing_generation_type',
        'invoice_number',
        'subtotal',
        'tax',
        'discount',
        'grand_total',
        'issue_date',
        'due_date',
        'paid_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => InvoiceStatus::class,
            'billing_generation_type' => BillingGenerationType::class,
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(CustomerService::class);
    }

    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
