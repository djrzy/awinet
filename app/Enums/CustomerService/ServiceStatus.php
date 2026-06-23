<?php

namespace App\Enums\CustomerService;

enum ServiceStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Suspended = 'suspended';
    case Terminated = 'terminated';

    public static function default(): self
    {
        return self::Pending;
    }
}
