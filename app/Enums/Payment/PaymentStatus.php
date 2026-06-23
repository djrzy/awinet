<?php

namespace App\Enums\Payment;

enum PaymentStatus: string
{
    case Pending = 'pending';
    case Completed = 'completed';
    case Failed = 'failed';
    case Expired = 'expired';
    case Cancelled = 'cancelled';
}
