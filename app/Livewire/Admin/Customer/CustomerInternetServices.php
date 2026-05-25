<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Component;

class CustomerInternetServices extends Component
{

    public Customer $customer;
    public $showModal = false;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function render()
    {
        return view('livewire.admin.customer.customer-internet-services');
    }
}
