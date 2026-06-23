<?php

namespace App\Enums\Invoice;

enum InvoiceStatus: string
{
    case Unpaid = 'unpaid';
    case Paid = 'paid';
    case Overdue = 'overdue';
    case Cancelled = 'cancelled';

    public static function default(): self
    {
        return self::Unpaid;
    }
}
