<?php

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
