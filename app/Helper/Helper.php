<?php

use Carbon\Carbon;

if (! function_exists('rupiah')) {
    function rupiah(
        int|float|string|null $amount,
        string $prefix = 'Rp '
    ): string {
        if (
            $amount === null ||
            $amount === ''
        ) {
            return '-';
        }

        return $prefix . number_format(
            (float) $amount,
            0,
            ',',
            '.'
        );
    }
}

if (! function_exists('date_time')) {
    function date_time(
        string|Carbon|null $date,
        string $format = 'd M Y H:i'
    ): string {
        if (! $date) {
            return '-';
        }

        return Carbon::parse($date)->translatedFormat($format);
    }
}

if (! function_exists('month_year')) {
    function month_year(
        string|Carbon|null $date,
        string $format = 'F Y'
    ): string {
        if (! $date) {
            return '-';
        }

        return Carbon::parse($date)->translatedFormat($format);
    }
}

if (! function_exists('full_date')) {
    function full_date(
        string|Carbon|null $date,
        string $format = 'd F Y'
    ): string {
        if (! $date) {
            return '-';
        }

        return Carbon::parse($date)->translatedFormat($format);
    }
}
