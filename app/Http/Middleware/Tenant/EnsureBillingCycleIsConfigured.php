<?php

namespace App\Http\Middleware\Tenant;

use App\Models\BillingCycle;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureBillingCycleIsConfigured
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->tenant_id) {

            // 1. TAHAPAN MINIMAL (FIXED): Loloskan form, internal Livewire, DAN ROUTE LOGOUT
            // Kita tambahkan pengecekan $request->is('logout') agar proses keluar aplikasi tidak dicegat
            if (
                $request->is('setting/billing-cycle') ||
                $request->is('logout') ||
                $request->hasHeader('X-Livewire') ||
                str_starts_with($request->path(), 'livewire/')
            ) {

                return $next($request);
            }

            // 2. Periksa apakah konfigurasi billing_cycles sudah dibuat oleh tenant ini
            $hasConfigured = BillingCycle::where('tenant_id', auth()->user()->tenant_id)->exists();

            // 3. Jika belum dikonfigurasi dan mencoba membuka halaman lain, barulah dipaksa ke halaman form
            if (!$hasConfigured) {
                return redirect()->route('admin.billing-cycles.create')
                    ->with('warn', 'Pemberitahuan Sistem: Anda diwajibkan untuk menentukan konfigurasi Siklus Penagihan (Billing Cycle) ISP Anda terlebih dahulu.');
            }
        }

        return $next($request);
    }
}
