<?php

namespace App\Livewire\Admin\InternetPlan;

use App\Models\InternetPlan as Model;
use Livewire\Component;
use Livewire\WithPagination;

class InternetPlan extends Component
{
    use WithPagination;

    public $name;
    public $description;
    public $download_speed;
    public $upload_speed;
    public $service_type;
    public $price;
    public $status = 1;
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public bool $isEdit = false;
    public ?Model $selectedPlan = null;
    public $perPage = 10;

    public array $serviceTypes = [
        'pppoe' => 'PPPoE',
        'dedicated' => 'Dedicated',
        'static' => 'Static',
        'hotspot' => 'Hotspot',
    ];

    protected function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'download_speed' => ['required', 'numeric'],
            'upload_speed' => ['required', 'numeric'],
            'service_type' => ['required'],
            'price' => ['required', 'numeric'],
            'status' => $this->isEdit ? ['required', 'boolean'] : ['nullable'],
        ];
    }

    protected function formData(): array
    {
        return [
            // 'tenant_id' => auth()->user()->tenant_id,
            'name' => $this->name,
            'description' => $this->description,
            'download_speed' => $this->download_speed,
            'upload_speed' => $this->upload_speed,
            'service_type' => $this->service_type,
            'status' => $this->status,
            'price' => $this->price,
        ];
    }

    protected function resetForm(): void
    {
        $this->reset([
            'name',
            'description',
            'download_speed',
            'upload_speed',
            'service_type',
            'price',
            'status',
            'selectedPlan',
        ]);
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function closeModal(): void
    {
        $this->resetForm();

        $this->showModal = false;

        $this->resetValidation();
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;

        $this->selectedPlan = null;
    }

    public function create(): void
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function viewEdit(int $id): void
    {
        $plan = Model::findOrFail($id);

        $this->selectedPlan = $plan;

        $this->fill([
            'name' => $plan->name,
            'description' => $plan->description,
            'download_speed' => $plan->download_speed,
            'upload_speed' => $plan->upload_speed,
            'service_type' => $plan->service_type,
            'status' => $plan->status,
            'price' => $plan->price,
        ]);

        $this->isEdit = true;

        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        Model::create($this->formData());

        $this->closeModal();

        $this->dispatch(
            'notify',
            title: 'Internet Plan Created',
            message: 'The internet plan has been created successfully.',
        );
    }

    public function update(): void
    {
        $this->validate();

        $this->selectedPlan?->update(
            $this->formData()
        );

        $this->closeModal();

        $this->dispatch(
            'notify',
            title: 'Internet Plan Updated',
            message: 'The internet plan has been updated successfully.'
        );
    }

    public function confirmDelete(int $id): void
    {
        $this->selectedPlan = Model::findOrFail($id);

        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        $this->selectedPlan?->delete();

        $this->dispatch(
            'notify',
            title: 'Internet Plan Deleted',
            message: 'Internet plan deleted successfully.'
        );

        $this->closeDeleteModal();
    }

    public function paginationView()
    {
        return 'components.pagination.index';
    }

    public function render()
    {
        $plans = Model::orderBy('price', 'asc')->paginate($this->perPage);

        return view(
            'livewire.admin.internet-plan.internet-plan',
            [
                'plans' => $plans
            ]
        );
    }
}
