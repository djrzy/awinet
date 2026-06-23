<?php

namespace App\Enums\InternetPlan;

enum InternetServiceType: string
{
    case PPPoE = 'pppoe';
    case Dedicated = 'dedicated';
    case Static = 'static';
    case Hotspot = 'hotspot';

    public function label(): string
    {
        return match ($this) {
            self::PPPoE => 'PPPoE',
            self::Dedicated => 'Dedicated',
            self::Static => 'Static',
            self::Hotspot => 'Hotspot',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $case) => [
                $case->value => $case->label(),
            ])
            ->all();
    }
}
