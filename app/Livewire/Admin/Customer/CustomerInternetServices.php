<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
use App\Models\CustomerService;
use Livewire\Component;

class CustomerInternetServices extends Component
{

    public Customer $customer;

    public ?CustomerService $service = null;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;

        $this->service = CustomerService::where('customer_id', $this->customer)->first();
    }

    public function render()
    {
        return view('livewire.admin.customer.customer-internet-services');
    }
}
