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
    public $status;
    public bool $showViewModal = false;
    public ?Model $selectedPlan = null;
    public ?int $editingId = null;
    public $perPage = 10;

    protected function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'download_speed' => ['required', 'numeric'],
            'upload_speed' => ['required', 'numeric'],
            'service_type' => ['required'],
            'status' => ['nullable'],
            'price' => ['required', 'numeric'],
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
            'editingId',
            'selectedPlan',
        ]);
    }

    public function paginationView()
    {
        return 'components.pagination.index';
    }

    public function viewPlan(int $id): void
    {
        $plan = Model::findOrFail($id);

        $this->selectedPlan = $plan;
        $this->editingId = $plan->id;

        // Populate form
        $this->name = $plan->name;
        $this->description = $plan->description;
        $this->download_speed = $plan->download_speed;
        $this->upload_speed = $plan->upload_speed;
        $this->service_type = $plan->service_type;
        $this->status = $plan->status;
        $this->price = $plan->price;

        $this->showViewModal = true;
    }

    public function save()
    {
        $this->validate();

        Model::create([
            // 'tenant_id' => auth()->user()->tenant_id,
            'name' => $this->name,
            'description' => $this->description,
            'download_speed' => $this->download_speed,
            'upload_speed' => $this->upload_speed,
            'service_type' => $this->service_type,
            'price' => $this->price,
        ]);

        // session()->flash('message', 'Internet plan created successfully.');

        $this->dispatch('internet-plan-created');

        // Reset form fields
        $this->resetForm();
    }

    public function update(): void
    {
        $this->validate();

        $plan = Model::findOrFail($this->editingId);

        $plan->update([
            'name' => $this->name,
            'description' => $this->description,
            'download_speed' => $this->download_speed,
            'upload_speed' => $this->upload_speed,
            'service_type' => $this->service_type,
            'status' => $this->status,
            'price' => $this->price,
        ]);

        $this->selectedPlan = $plan->fresh();

        $this->showViewModal = false;

        $this->dispatch('internet-plan-updated');

        $this->resetForm();
    }

    public function delete(Model $plan)
    {
        $plan->delete();

        session()->flash('message', 'Internet plan deleted successfully.');
    }

    public function render()
    {
        $plans = Model::paginate($this->perPage);

        return view(
            'livewire.admin.internet-plan.internet-plan',
            [
                'plans' => $plans
            ]
        );
    }
}
