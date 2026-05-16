<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Component;

class CustomerShow extends Component
{
    public Customer $customer;

    // user fields
    public $name;
    public $email;
    public $phone;

    // customer fields
    public $nik;
    public $address;
    public $postal_code;

    // map
    public $latitude;
    public $longitude;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;

        // user
        $this->name = $customer->user->name;
        $this->email = $customer->user->email;
        $this->phone = $customer->user->phone;

        // customer
        $this->nik = $customer->nik;
        $this->address = $customer->address;
        $this->postal_code = $customer->postal_code;

        // map
        $this->latitude = $customer->latitude;
        $this->longitude = $customer->longitude;
    }

    protected function rules()
    {
        return [

            // user
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email,' . $this->customer->user->id
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20'
            ],

            // customer
            'nik' => [
                'nullable',
                'string',
                'max:30'
            ],

            'address' => [
                'nullable',
                'string'
            ],

            'postal_code' => [
                'nullable',
                'string',
                'max:10'
            ],

            // map
            'latitude' => [
                'nullable',
                'numeric'
            ],

            'longitude' => [
                'nullable',
                'numeric'
            ],
        ];
    }

    public function delete()
    {
        $this->customer->user()->delete();

        $this->customer->delete();

        session()->flash(
            'success',
            'Customer deleted successfully.'
        );

        return redirect()
            ->route('customer');
    }

    public function save()
    {
        $this->validate();

        // update user
        $this->customer->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        // update customer
        $this->customer->update([
            'nik' => $this->nik,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        $this->dispatch('customer-updated');
    }

    public function render()
    {
        return view('livewire.admin.customer.customer-show');
    }
}
