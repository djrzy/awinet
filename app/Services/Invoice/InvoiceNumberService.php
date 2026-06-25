<?php

namespace App\Services\Invoice;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Str;

class InvoiceNumberService
{
    /**
     * Generate Nomor Invoice Unik berbasis Karakter Acak (Sesuai pola awal Anda)
     * Contoh hasil: INV-20260625-AB89X
     */
    public function generateRandomPattern(string $prefix = 'INV'): string
    {
        do {
            $date = Carbon::now()->format('Ymd');
            $randomString = strtoupper(Str::random(5));
            $invoiceNumber = "{$prefix}-{$date}-{$randomString}";

            // Validasi ke database untuk memastikan benar-benar unik (menghindari bentrokan kueri)
            $exists = Invoice::where('invoice_number', $invoiceNumber)->exists();
        } while ($exists);

        return $invoiceNumber;
    }

    /**
     * REKOMENDASI ISP PROFESIONAL: Generate Nomor Urut Urut/Sekuensial per Bulan
     * Contoh hasil: INV/2026/06/0001, INV/2026/06/0002
     * Keunggulan: Sangat rapi untuk pembukuan akuntansi & audit keuangan ISP.
     */
    public function generateSequentialPattern(string $prefix = 'INV'): string
    {
        $now = Carbon::now();
        $year = $now->format('Y');
        $month = $now->format('m');

        // Cari nomor invoice terakhir pada bulan dan tahun berjalan (terisolasi per tenant otomatis via Trait)
        $lastInvoice = Invoice::whereYear('issue_date', $year)
            ->whereMonth('issue_date', $month)
            ->where('invoice_number', 'like', "{$prefix}/{$year}/{$month}/%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastInvoice) {
            // Ambil 5 digit terakhir nomor urut, lalu naikkan nilainya (+1)
            $lastNumber = (int) substr($lastInvoice->invoice_number, -5);
            $nextNumber = $lastNumber + 1;
        } else {
            // Jika belum ada invoice sama sekali di bulan ini, mulai dari 1
            $nextNumber = 1;
        }

        // Susun nomor dengan padding angka 0 di depan (cth: 00001, 00012, 00123)
        $sequence = str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        return "{$prefix}/{$year}/{$month}/{$sequence}";
    }
}
