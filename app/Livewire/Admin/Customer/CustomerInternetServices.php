<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
use App\Models\InternetPlan;
use Livewire\Component;

class CustomerInternetServices extends Component
{

    public Customer $customer;
    public $showModal = false;
    public $isEdit = false;
    public $modalMode = 'assign';
    public $selectedService = null;
    public $statusAction = null;

    public $service_name;
    public $username;
    public $password;
    public $status = 'pending';
    public $activation_date;
    public $expiration_date;
    public $deactivation_date;
    public $installation_address;
    public $similar_address = null;
    public $latitude;
    public $longitude;
    public $router_id;
    public $internet_plan_id;
    public array $internetPlans = [];

    public function formData(): array
    {
        $installationAddress = $this->installation_address;
        $latitude = $this->latitude;
        $longitude = $this->longitude;

        if ((int) $this->similar_address === 1) {
            $installationAddress = $this->customer->address;
            $latitude = $this->customer->latitude;
            $longitude = $this->customer->longitude;
        }

        return [
            'customer_id' => $this->customer->id,
            'service_name' => $this->service_name,
            'username' => $this->username,
            'password' => $this->password,
            'activation_date' => $this->activation_date,
            'expiration_date' => $this->expiration_date,
            'deactivation_date' => $this->deactivation_date,
            'installation_address' => $installationAddress,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'router_id' => $this->router_id,
            'internet_plan_id' => $this->internet_plan_id,
            'status' => $this->status,
        ];
    }

    public function resetForm()
    {
        $this->reset([
            'service_name',
            'username',
            'password',
            'activation_date',
            'expiration_date',
            'deactivation_date',
            'installation_address',
            'latitude',
            'longitude',
            'router_id',
            'internet_plan_id',
        ]);

        $this->status = 'pending';
        $this->similar_address = null;
        $this->selectedService = null;
        $this->statusAction = null;

        $this->dispatch(
            'refresh-map',
            id: 'create-service-map',
            clear: true
        );
    }

    public function assign()
    {
        $this->resetForm();

        $this->modalMode = 'assign';
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;

        $this->resetForm();

        $this->isEdit = false;
        $this->modalMode = 'assign';
    }

    public function updatedSimilarAddress($value)
    {
        if ((int) $value === 1) {
            $this->installation_address = $this->customer->address;
            $this->latitude = $this->customer->latitude;
            $this->longitude = $this->customer->longitude;

            return;
        }

        $this->dispatch(
            'refresh-map',
            id: 'create-service-map'
        );

        $this->installation_address = null;
        $this->latitude = null;
        $this->longitude = null;
    }

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        $this->internetPlans = InternetPlan::query()
            ->orderBy('price', 'asc')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function rules(): array
    {
        return [
            'service_name' => 'required|string|max:255',
            'username' => 'nullable',
            'password' => 'nullable',
            'similar_address' => 'required|boolean',
            'activation_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after_or_equal:activation_date',
            'deactivation_date' => 'nullable|date|after_or_equal:activation_date',
            'installation_address' => ['required_if:similar_address,0', 'nullable', 'string', 'max:255'],
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'router_id' => 'nullable|integer|exists:routers,id',
            'internet_plan_id' => 'required|integer|exists:internet_plans,id',
        ];
    }

    public function viewEdit($serviceId)
    {
        $service = $this->customer
            ->services()
            ->findOrFail($serviceId);

        $this->selectedService = $service;

        $this->fill([
            'service_name' => $service->service_name,
            'username' => $service->username,
            'password' => $service->password,
            'status' => $service->status,
            'activation_date' => $service->activation_date,
            'expiration_date' => $service->expiration_date,
            'deactivation_date' => $service->deactivation_date,
            'installation_address' => $service->installation_address,
            'latitude' => $service->latitude,
            'longitude' => $service->longitude,
            'router_id' => $service->router_id,
            'internet_plan_id' => $service->internet_plan_id,
        ]);

        $this->similar_address =
            $service->installation_address === $this->customer->address
            ? 1
            : 0;

        $this->modalMode = 'view-edit';
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->customer->services()->create($this->formData());

        $this->closeModal();

        $this->dispatch(
            'notify',
            title: 'Success',
            message: 'Internet service assigned successfully.',
        );
    }

    public function changePlan($serviceId)
    {
        $service = $this->customer
            ->services()
            ->findOrFail($serviceId);

        $this->selectedService = $service;
        $this->internet_plan_id = $service->internet_plan_id;

        $this->modalMode = 'change-plan';
        $this->showModal = true;
    }

    public function serviceStatus($serviceId, $action)
    {
        $service = $this->customer
            ->services()
            ->findOrFail($serviceId);

        $this->selectedService = $service;
        $this->statusAction = $action;

        $this->modalMode = 'service-status';
        $this->showModal = true;
    }

    public function routerSettings($serviceId)
    {
        $service = $this->customer
            ->services()
            ->findOrFail($serviceId);

        $this->selectedService = $service;
        $this->router_id = $service->router_id;

        $this->modalMode = 'router-settings';
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.admin.customer.customer-internet-services');
    }
}
