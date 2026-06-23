<?php

namespace App\Enums\Invoice;

enum BillingGenerationType: string
{
    case System = 'system';
    case Manual = 'manual';

    public function label(): string
    {
        return match ($this) {
            self::System => 'System',
            self::Manual => 'Manual'
        };
    }
}
