<?php

namespace App\Models;

use App\Enums\Payment\PaymentStatus;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected function casts(): array
    {
        return [
            'status' => PaymentStatus::class,
        ];
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
