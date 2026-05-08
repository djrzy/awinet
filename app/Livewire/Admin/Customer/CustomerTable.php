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
            ->join('users', 'users.id', '=', 'customers.user_id')

            ->select('customers.*')

            ->where(function ($query) {
                $query
                    ->where('customers.customer_code', 'like', '%' . $this->search . '%')
                    ->orWhere('customers.status', 'like', '%' . $this->search . '%')
                    ->orWhere('users.name', 'like', '%' . $this->search . '%');
            })

            ->with('user')

            ->when(
                $this->sortBy,
                function ($query) {
                    $query->orderBy(
                        $this->sortBy === 'name'
                            ? 'users.name'
                            : 'customers.' . $this->sortBy,
                        $this->sortDirection
                    );
                },
                function ($query) {
                    $query->latest('customers.created_at');
                }
            )

            ->paginate($this->perPage);

        return view('livewire.customer.customer-table', [
            'customers' => $customers
        ]);
    }
}
