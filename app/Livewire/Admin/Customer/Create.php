<?php

namespace App\Livewire\Admin\Customer;

use App\Services\CustomerServices;
use Livewire\Component;

class Create extends Component
{

    public $name;
    public $email;
    public $phone;
    public $nik;
    public $address;
    public $postal_code;
    public $latitude = null;
    public $longitude = null;

    public function resetForm()
    {
        $this->reset([
            'name',
            'email',
            'phone',
            'nik',
            'address',
            'postal_code',
        ]);

        $this->latitude = -6.38772;
        $this->longitude = 105.92078;
    }

    public function save(CustomerServices $customerService)
    {
        $validated = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable',
            'nik' => 'nullable',
            'address' => 'required',
            'postal_code' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ]);

        $customerService->create($validated);

        $this->resetForm();

        $this->dispatch('customer-created');
    }

    public function render()
    {
        return view('livewire.customer.create');
    }
}
