<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerTable extends Component
{
    use WithPagination;

    public ?string $sortBy = null;
    public ?string $sortDirection = null;
    public int $perPage = 10;
    public array $perPageOptions = [5, 10, 25, 50, 100];
    public string $search = '';

    public function sort($column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection =
                $this->sortDirection === 'asc'
                ? 'desc'
                : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function updatedPerPage($value): void
    {
        if (! in_array((int) $value, $this->perPageOptions)) {
            $this->perPage = 10;
        }

        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'components.pagination.index';
    }

    public function render()
    {
        $customers = Customer::query()
            // Direct inner join for searching constraints
            ->join('users', 'users.id', '=', 'customers.user_id')

            // Explicitly select only customer columns to preserve relationship mapping
            ->select('customers.*')

            // Search query constraint mapping block
            ->where(function ($query) {
                $term = '%' . $this->search . '%';
                $query->where('customers.customer_code', 'like', $term)
                    ->orWhere('customers.status', 'like', $term)
                    ->orWhere('users.name', 'like', $term);
            })

            // OPTIMIZATION: Eager load only the specific relation columns utilized on your table row
            ->with('user:id,name,phone')

            // Cleaned Up Sorting Sequence Logic
            ->when($this->sortBy, function ($query) {
                $orderColumn = match ($this->sortBy) {
                    'name' => 'users.name',
                    default => 'customers.' . $this->sortBy,
                };
                $query->orderBy($orderColumn, $this->sortDirection);
            }, function ($query) {
                $query->latest('customers.created_at');
            })
            ->paginate($this->perPage);

        return view('livewire.admin.customer.customer-table', [
            'customers' => $customers
        ]);
    }
}
