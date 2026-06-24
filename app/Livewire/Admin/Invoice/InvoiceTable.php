<?php

namespace App\Livewire\Admin\Invoice;

use App\Models\Customer;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceTable extends Component
{
    use WithPagination;

    // Table State & Filtering
    public int $perPage = 10;
    public string $search = '';
    public string $payment_status = 'any'; // Default to match your blade option value
    public ?string $billing_period_range = ''; // Captures Flatpickr range string

    // Sorting State
    public ?string $sortBy = null;
    public ?string $sortDirection = null;

    // Modal Form State
    public bool $showModal = false;
    public array $customers = [];
    public array $items = [];
    public $customer_id = null;

    public array $perPageOptions = [5, 10, 25, 50, 100];

    public function mount(): void
    {
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
        $this->items[] = [
            'description' => '',
            'price' => ''
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

    public function create()
    {
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }

    public function getTotalProperty(): float
    {
        return collect($this->items)->sum(function ($item) {
            $price = filter_var($item['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            return is_numeric($price) ? (float) $price : 0.0;
        });
    }

    public function save()
    {
        $this->validate([
            'customer_id' => 'required',
            'items.*.description' => 'required|string',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Proceed with Invoice and InvoiceItems storage database workflow...
    }

    public function render()
    {
        $invoicesQuery = Invoice::query()
            ->join('customers', 'invoices.customer_id', '=', 'customers.id')
            ->join('users', 'customers.user_id', '=', 'users.id')
            ->select('invoices.*')
            ->with(['customer.user:id,name'])
            // 1. Text Searching Constraint Box
            ->where(function ($query) {
                $term = '%' . $this->search . '%';
                $query->where('invoices.invoice_number', 'like', $term)
                    ->orWhere('users.name', 'like', $term);
            });
        // 2. Dropdown Status Filter
        if ($this->payment_status && $this->payment_status !== 'any') {
            $invoicesQuery->where('invoices.status', $this->payment_status);
        }
        // 3. Flatpickr Month Range Filter (Format parsed: 'YYYY-MM to YYYY-MM')
        if (!empty($this->billing_period_range)) {
            $periods = explode(' to ', $this->billing_period_range);
            if (count($periods) === 2) {
                $invoicesQuery->whereBetween('invoices.billing_period', [$periods[0], $periods[1]]);
            } else {
                // If user selected only a single starting month so far
                $invoicesQuery->where('invoices.billing_period', $periods[0]);
            }
        }
        // 4. Dynamic Ordering Execution Sequence
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
