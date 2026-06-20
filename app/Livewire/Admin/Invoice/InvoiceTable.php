<?php

namespace App\Livewire\Admin\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class InvoiceTable extends Component
{
    public $perPage = 10;
    public $search = '';

    public function render()
    {
        $invoices = Invoice::with('customer')->get();
        // $invoices = Invoice::query()
        //     // ->join()

        //     ->select('invoices.*')

        //     ->where(function ($query) {
        //         $query
        //             ->where('invoices.invoice_number', 'like', '%' . $this->search . '%')
        //             // ->orWhere('invoices.status', 'like', '%' . $this->search . '%')
        //             // ->orWhere('users.name', 'like', '%' . $this->search . '%')
        //         ;
        //     })

        //     // ->with('user')

        //     ->when(
        //         // $this->sortBy,
        //         // function ($query) {
        //         //     $query->orderBy(
        //         //         $this->sortBy === 'name'
        //         //             ? 'users.name'
        //         //             : 'customers.' . $this->sortBy,
        //         //         $this->sortDirection
        //         //     );
        //         // },
        //         // function ($query) {
        //         //     $query->latest('customers.created_at');
        //         // }
        //     )

        //     ->paginate($this->perPage);

        return view('livewire.admin.invoice.invoice-table', [
            'invoices' => $invoices
        ]);
    }
}
