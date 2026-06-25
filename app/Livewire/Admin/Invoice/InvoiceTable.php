<?php

namespace App\Livewire\Admin\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Enums\Invoice\InvoiceStatus;
use App\Enums\Invoice\BillingGenerationType;
use App\Services\Invoice\InvoiceNumberService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceTable extends Component
{
    use WithPagination;

    // Table State & Filtering
    public int $perPage = 10;
    public string $search = '';
    public string $payment_status = 'any';
    public ?string $billing_period_range = '';

    // Sorting State
    public ?string $sortBy = null;
    public ?string $sortDirection = null;

    // Modal Form State
    public bool $showModal = false;
    public array $customers = [];
    public array $items = [];
    public $customer_id = null;
    public int $due_date;

    public array $perPageOptions = [5, 10, 25, 50, 100];

    public function mount(): void
    {
        // Isolasi data customer otomatis menggunakan Global Scope tenant_id
        $this->customers = Customer::query()
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select([
                'customers.id as customer_id',
                'customers.customer_code',
                'users.name as user_name'
            ])
            ->toBase()
            ->get()
            ->map(fn($customer) => [
                'id' => $customer->customer_id,
                'label' => sprintf(
                    '%s - %s',
                    $customer->customer_code ?? 'No Code',
                    $customer->user_name ?? 'Unknown User'
                ),
            ])
            ->toArray();

        $this->addItem();
    }

    public function sort($column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPaymentStatus(): void
    {
        $this->resetPage();
    }

    public function updatedBillingPeriodRange(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage($value): void
    {
        if (! in_array((int) $value, $this->perPageOptions, true)) {
            $this->perPage = 10;
        }
        $this->resetPage();
    }

    public function addItem(): void
    {
        // Disesuaikan dengan penamaan kolom pada input modal Blade Anda
        $this->items[] = [
            'name' => '',
            'quantity' => 1,
            'unit_price' => '',
            'total_price' => 0
        ];
    }

    public function removeItem($index): void
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);

        if (empty($this->items)) {
            $this->addItem();
        }
    }

    // Melakukan update perhitungan sub-total harga per baris saat quantity / unit_price diketik
    public function updatedItems($value, $key): void
    {
        // Format key yang masuk: "0.quantity" atau "1.unit_price"
        if (Str::contains($key, ['.quantity', '.unit_price'])) {
            $parts = explode('.', $key);
            $index = $parts[0];

            $quantity = (int) ($this->items[$index]['quantity'] ?? 0);
            $unitPrice = (float) ($this->items[$index]['unit_price'] ?? 0);

            $this->items[$index]['total_price'] = $quantity * $unitPrice;
        }
    }

    public function create()
    {
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->reset(['customer_id', 'items']);
        $this->addItem();
    }

    public function getTotalProperty(): float
    {
        return collect($this->items)->sum(function ($item) {
            return (float) ($item['total_price'] ?? 0.0);
        });
    }

    public function save(InvoiceNumberService $invoiceBuilder)
    {
        $this->validate([
            'customer_id' => 'required|exists:customers,id',
            'due_date' => 'required|integer|min:1',
            'items.*.name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($invoiceBuilder) {
            $invoiceNumber = $invoiceBuilder->generateSequentialPattern('INV');
            $now = Carbon::now();
            $year = $now->format('Y');
            $month = $now->format('m');

            // 1. Catat data Header Invoice (tenant_id otomatis terisi oleh Global Scope Trait Anda)
            $invoice = Invoice::create([
                'customer_id' => $this->customer_id,
                'invoice_number' => $invoiceNumber,
                'billing_period' => $year . '-' . $month,
                'issue_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDays($this->due_date), // Batas pembayaran default 7 hari
                'subtotal' => $this->total,
                'grand_total' => $this->total,
                'status' => InvoiceStatus::Draft,
                'billing_generation_type' => BillingGenerationType::Manual,
            ]);

            // 2. Loop dan catat baris detail item mengikuti Migration tabel Anda secara presisi
            foreach ($this->items as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'service_id' => null, // Invoice manual dibuat fleksibel tanpa ikatan layanan internet tertentu
                    'name' => $item['name'],
                    'description' => $item['name'], // Deskripsi kita isi serasi dengan nama item
                    'quantity' => (int) $item['quantity'],
                    'unit_price' => (float) $item['unit_price'],
                    'total_price' => (int) $item['quantity'] * (float) $item['unit_price'],
                ]);
            }
        });

        $this->closeModal();

        $this->dispatch(
            'notify',
            title: 'Success',
            message: 'Manual invoice and items have been created successfully.',
        );
    }

    public function paginationView()
    {
        return 'components.pagination.index';
    }

    public function render()
    {
        // Membatasi tabel join invoices.tenant_id agar aman dari ambiguous error column
        $invoicesQuery = Invoice::query()
            ->join('customers', 'invoices.customer_id', '=', 'customers.id')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select('invoices.*')
            ->with(['customer.user:id,name'])
            ->where(function ($query) {
                $term = '%' . $this->search . '%';
                $query->where('invoices.invoice_number', 'like', $term)
                    ->orWhere('users.name', 'like', $term);
            });

        if ($this->payment_status && $this->payment_status !== 'any') {
            $invoicesQuery->where('invoices.status', $this->payment_status);
        }

        if (!empty($this->billing_period_range)) {
            $periods = explode(' to ', $this->billing_period_range);
            if (count($periods) === 2) {
                $invoicesQuery->whereBetween('invoices.billing_period', [$periods[0], $periods[1]]);
            } else {
                $invoicesQuery->where('invoices.billing_period', $periods[0]);
            }
        }

        $invoicesQuery->when($this->sortBy, function ($query) {
            $orderColumn = match ($this->sortBy) {
                'status'         => 'invoices.status',
                'customer_name'  => 'users.name',
                'billing_period' => 'invoices.billing_period',
                'invoice_number' => 'invoices.invoice_number',
                default          => 'invoices.created_at',
            };
            $query->orderBy($orderColumn, $this->sortDirection);
        }, function ($query) {
            $query->latest('invoices.created_at');
        });

        return view('livewire.admin.invoice.invoice-table', [
            'invoices' => $invoicesQuery->paginate($this->perPage),
            'total' => $this->total,
        ]);
    }
}
