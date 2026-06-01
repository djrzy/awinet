<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Component;
use App\Models\InternetPlan;

class CustomerInternetServices extends Component
{

    public Customer $customer;
    public $showModal = false;
    public $isEdit = false;

    public $service_name;
    public $username;
    public $password;
    public $status = 'pending';
    public $activation_date;
    public $expiration_date;
    public $deactivation_date;
    public $installation_address;
    public $latitude;
    public $longitude;
    public $router_id;
    public $internet_plan_id;

    public function internetPlans(): array
    {
        return InternetPlan::query()
            ->pluck('name', 'id')
            ->toArray();
    }

    public function assign(Customer $customer)
    {
        $this->showModal = true;
        $this->customer = $customer;
    }

    public function closeModal()
    {
        $this->showModal = false;
        // $this->reset(['customer', 'isEdit']);
    }

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function render()
    {
        return view('livewire.admin.customer.customer-internet-services');
    }
}
