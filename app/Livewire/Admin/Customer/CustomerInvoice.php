<?php

namespace App\Livewire\Admin\Customer;

use App\Enums\Invoice\BillingGenerationType;
use App\Enums\Invoice\InvoiceStatus;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Services\Invoice\InvoiceNumberService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerInvoice extends Component
{
    use WithPagination;

    public Customer $customer;

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
    public ?int $due_date = 7; // Mengatur default tempo 7 hari agar form tidak kosong/error
    public $discount = 0;

    public array $perPageOptions = [5, 10, 25, 50, 100];

    public function mount(): void
    {
        // Mengunci Pilihan drop-down di modal hanya untuk data customer yang aktif saat ini
        $this->customers = Customer::query()
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select([
                'customers.id as customer_id',
                'customers.customer_code',
                'users.name as user_name'
            ])
            ->toBase()
            ->where('customers.id', $this->customer->id) // Memastikan isolasi data target
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

        // Otomatis mengunci value default form customer_id ke ID Pelanggan aktif
        $this->customer_id = $this->customer->id;

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

    public function updatedItems($value, $key): void
    {
        if (Str::contains($key, ['.quantity', '.unit_price'])) {
            $parts = explode('.', $key);
            $index = $parts[0];

            $this->calculateItemTotal((int) $index);
        }
    }

    protected function calculateItemTotal(int $index): void
    {
        if (! isset($this->items[$index])) {
            return;
        }

        $quantity = (float) ($this->items[$index]['quantity'] ?? 0);
        $unitPrice = (float) ($this->items[$index]['unit_price'] ?? 0);

        $this->items[$index]['total_price'] = $quantity * $unitPrice;
    }

    public function create()
    {
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        // customer_id tidak ikut di-reset agar form modal selanjutnya tetap terkunci ke customer aktif
        $this->reset(['items', 'discount']);
        $this->due_date = 7;
        $this->addItem();
    }

    public function getTotalProperty(): float
    {
        $subtotal = collect($this->items)->sum(function ($item) {
            return (float) ($item['total_price'] ?? 0.0);
        });

        $discountAmount = (float) $this->discount;
        $grandTotal = $subtotal - $discountAmount;

        return $grandTotal < 0 ? 0.0 : $grandTotal;
    }

    public function save(InvoiceNumberService $invoiceBuilder)
    {
        // Validasi data
        $this->validate([
            'customer_id' => 'required|in:' . $this->customer->id, // Mengunci agar tidak bisa dimanipulasi pihak luar
            'due_date' => 'required|integer|min:1',
            'items.*.name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0'
        ]);

        DB::transaction(function () use ($invoiceBuilder) {
            $invoiceNumber = $invoiceBuilder->generateSequentialPattern('INV');

            $subtotal = collect($this->items)->sum(function ($item) {
                return (int) $item['quantity'] * (float) $item['unit_price'];
            });

            $discountAmount = (float) $this->discount;
            $grandTotal = $subtotal - $discountAmount;
            if ($grandTotal < 0) {
                $grandTotal = 0;
            }

            $now = Carbon::now();
            $year = $now->format('Y');
            $month = $now->format('m');

            // 1. Catat data Header Invoice (Terikat langsung ke pelanggan aktif)
            $invoice = Invoice::create([
                'customer_id' => $this->customer->id,
                'invoice_number' => $invoiceNumber,
                'billing_period' => $year . '-' . $month,
                'issue_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDays($this->due_date),
                'subtotal' => $subtotal,
                'grand_total' => $grandTotal,
                'status' => InvoiceStatus::Draft,
                'billing_generation_type' => BillingGenerationType::Manual,
                'discount' => $discountAmount,
            ]);

            // 2. Catat detail item invoice
            foreach ($this->items as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'service_id' => null,
                    'name' => $item['name'],
                    'description' => $item['name'],
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
            message: 'Manual invoice for this customer has been created successfully.',
        );
    }

    public function paginationView()
    {
        return 'components.pagination.index';
    }

    public function render()
    {
        // Mengunci kueri tabel histori tagihan agar HANYA memunculkan tagihan milik pelanggan ini saja
        $invoicesQuery = Invoice::query()
            ->join('customers', 'invoices.customer_id', '=', 'customers.id')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select('invoices.*')
            ->with(['customer.user:id,name'])
            ->where('invoices.customer_id', $this->customer->id)
            ->where(function ($query) {
                $term = '%' . $this->search . '%';
                $query->where('invoices.invoice_number', 'like', $term);
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
                'billing_period' => 'invoices.billing_period',
                'invoice_number' => 'invoices.invoice_number',
                default          => 'invoices.created_at',
            };
            $query->orderBy($orderColumn, $this->sortDirection);
        }, function ($query) {
            $query->latest('invoices.created_at');
        });

        return view('livewire.admin.customer.customer-invoice', [
            'invoices' => $invoicesQuery->paginate($this->perPage),
            'total' => $this->total,
        ]);
    }
}
