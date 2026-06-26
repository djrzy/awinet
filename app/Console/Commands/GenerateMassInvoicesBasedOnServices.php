<?php

namespace App\Console\Commands;

use App\Enums\Invoice\BillingGenerationType;
use App\Enums\Invoice\InvoiceStatus;
use App\Models\BillingCycle;
use App\Models\CustomerService;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Services\Invoice\InvoiceNumberService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateMassInvoicesBasedOnServices extends Command
{
    protected $signature = 'billing:generate-mass';
    protected $description = 'Otomatis membuat invoice bulanan massal berdasarkan layanan internet pelanggan yang aktif';

    public function handle(InvoiceNumberService $invoiceBuilder)
    {
        $this->info('=== Memulai Pengecekan Layanan Internet Pelanggan ===');

        $today = Carbon::now();
        $currentYearMonth = $today->format('Y-m');

        $stats = [
            'processed' => 0,
            'skipped_invalid' => 0,
            'skipped_new_activation' => 0,
            'skipped_not_billing_day' => 0,
            'skipped_already_invoiced' => 0,
            'success_generated' => 0
        ];

        CustomerService::query()
            ->where('status', 'active')
            ->with(['customer.user', 'internet_plan'])
            ->chunk(100, function ($services) use ($invoiceBuilder, $today, $currentYearMonth, &$stats) {
                foreach ($services as $service) {
                    $stats['processed']++;

                    // -----------------------------------------------------------------
                    // PENGAMAN 1: Validasi Integritas Data Relasi & Tenant ID
                    // -----------------------------------------------------------------
                    if (!$service->customer || !$service->internet_plan || is_null($service->tenant_id)) {
                        $this->error("Layanan ID #{$service->id}: Dilewati karena data Customer, Paket, atau Tenant ID bernilai null.");
                        $stats['skipped_invalid']++;
                        continue;
                    }

                    $customerName = $service->customer->user->name ?? 'Unknown';
                    $activationDate = Carbon::parse($service->activation_date);
                    $planName = $service->internet_plan->name ?? 'Tanpa Paket';

                    // -----------------------------------------------------------------
                    // PENGAMAN 2: Isolasi Bulan Pertama (Aktivasi Baru)
                    // -----------------------------------------------------------------
                    if ($activationDate->format('Y-m') === $currentYearMonth) {
                        $this->comment("Layanan #{$service->id} ({$customerName}): Dilewati karena baru aktif pada bulan ini ({$currentYearMonth}).");
                        $stats['skipped_new_activation']++;
                        continue;
                    }

                    // -----------------------------------------------------------------
                    // PENGAMAN 3: Sinkronisasi Hari Penagihan Berdasarkan Aturan Billing Cycle Tenant
                    // -----------------------------------------------------------------
                    $billingCycleSetting = BillingCycle::where('tenant_id', $service->tenant_id)->first();

                    if (!$billingCycleSetting) {
                        $this->error("Layanan ID #{$service->id} ({$customerName}): Dilewati karena Tenant ID #{$service->tenant_id} belum mengatur Billing Cycle.");
                        $stats['skipped_invalid']++;
                        continue;
                    }

                    $billingType = $billingCycleSetting->billing_type;
                    $dueDateInterval = is_numeric($billingCycleSetting->due_date) ? (int) $billingCycleSetting->due_date : 7;
                    $isBillingDay = false;
                    $expectedDay = 0;

                    if ($billingType === 'fixed') {
                        if (!$billingCycleSetting->billing_date) {
                            $this->error("Tenant ID #{$service->tenant_id}: Dilewati karena memilih tipe 'fixed' tetapi 'billing_date' kosong.");
                            continue;
                        }

                        $fixedDay = is_numeric($billingCycleSetting->billing_date)
                            ? (int) $billingCycleSetting->billing_date
                            : Carbon::parse($billingCycleSetting->billing_date)->day;

                        $expectedDay = $fixedDay;

                        // Hari penagihan COCOK dengan hari ini
                        if ($today->day === $fixedDay) {
                            $isBillingDay = true;
                        }
                        // Proteksi akhir bulan pendek (Misal pas diset tgl 31, tapi bulan ini cuma ada 30 hari)
                        unset($totalDaysInMonth);
                        if ($today->isLastOfMonth() && $fixedDay > $today->daysInMonth) {
                            $isBillingDay = true;
                        }
                    } else {
                        // JIKA ANNIVERSARY DATE
                        $expectedDay = $activationDate->day;

                        if ($today->day === $expectedDay) {
                            $isBillingDay = true;
                        }
                        // Proteksi akhir bulan pendek untuk anniversary
                        if ($today->isLastOfMonth() && $expectedDay > $today->daysInMonth) {
                            $isBillingDay = true;
                        }
                    }

                    // Jika hari ini bukan jadwal rilis tagihannya, LEWATKAN
                    if (!$isBillingDay) {
                        $this->line("Layanan #{$service->id} ({$customerName}): Dilewati karena hari penagihan seharusnya tanggal {$expectedDay}.");
                        $stats['skipped_not_billing_day']++;
                        continue;
                    }

                    // -----------------------------------------------------------------
                    // PENGAMAN 4: Kunci Duplikasi Tingkat Layanan
                    // -----------------------------------------------------------------
                    $invoiceExists = Invoice::where('customer_id', $service->customer_id)
                        ->where('billing_period', $currentYearMonth)
                        ->whereHas('invoice_items', function ($itemQuery) use ($service) {
                            $itemQuery->where('service_id', $service->id);
                        })
                        ->exists();

                    if ($invoiceExists) {
                        $this->warn("Layanan #{$service->id} ({$customerName} - Paket: {$planName}): Dilewati karena paket internet untuk periode {$currentYearMonth} SUDAH PERNAH DITERBITKAN.");
                        $stats['skipped_already_invoiced']++;
                        continue;
                    }

                    // -----------------------------------------------------------------
                    // EKSEKUSI PEMBUATAN INVOICE
                    // -----------------------------------------------------------------
                    DB::transaction(function () use ($service, $invoiceBuilder, $today, $currentYearMonth, &$stats, $customerName, $dueDateInterval, $planName) {
                        $invoiceNumber = $invoiceBuilder->generateSequentialPattern('INV');
                        $plan = $service->internet_plan;
                        $dueDate = $today->copy()->addDays($dueDateInterval);

                        $invoice = Invoice::create([
                            'tenant_id' => $service->tenant_id,
                            'customer_id' => $service->customer_id,
                            'service_id' => $service->id,
                            'invoice_number' => $invoiceNumber,
                            'billing_period' => $currentYearMonth,
                            'issue_date' => $today,
                            'due_date' => $dueDate,
                            'subtotal' => $plan->price,
                            'grand_total' => $plan->price,
                            'status' => InvoiceStatus::Unpaid,
                            'billing_generation_type' => BillingGenerationType::System,
                            'discount' => 0,
                        ]);

                        $periodeAwal = $today->format('d/m/Y');
                        $periodeAkhir = $today->copy()->addMonth()->format('d/m/Y');

                        InvoiceItem::create([
                            'invoice_id' => $invoice->id,
                            'service_id' => $service->id,
                            'name' => 'Biaya Langganan Paket ' . $planName,
                            'description' => "Layanan Internet Paket {$planName} - Periode {$periodeAwal} s/d {$periodeAkhir}",
                            'quantity' => 1,
                            'unit_price' => $plan->price,
                            'total_price' => $plan->price,
                        ]);

                        $this->info("✔ BERHASIL GENERATE INVOICE: #{$invoiceNumber} untuk {$customerName} (Layanan ID #{$service->id})");
                        $stats['success_generated']++;
                    });
                }
            });

        $this->info("\n=== RANGKUMAN EKSEKUSI MASS BILLING ===");
        $this->line("Total Layanan Aktif Diperiksa : {$stats['processed']}");
        $this->error("Dilewati karena Data Rusak/Invalid : {$stats['skipped_invalid']}");
        $this->comment("Dilewati karena Aktivasi Baru      : {$stats['skipped_new_activation']}");
        $this->line("Dilewati karena Belum Hari Tagihan : {$stats['skipped_not_billing_day']}");
        $this->warn("Dilewati karena Sudah Ber-Invoice  : {$stats['skipped_already_invoiced']}");
        $this->info("Total Sukses Invoice Diterbitkan  : {$stats['success_generated']}");
    }
}
