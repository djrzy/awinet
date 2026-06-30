<?php

namespace App\Livewire\Admin\Router;

use App\Models\Router;
use Livewire\Component;
use Livewire\WithPagination;

class RouterTable extends Component
{
    use WithPagination;

    public $showModal = false;
    public $isEdit = false;
    public $selectedRouterId = null;

    // Form Properties
    public $name;
    public $host;
    public $username;
    public $password;
    public $port = 8728;
    public $description;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'host' => 'required|string|max:255', // Bisa IP (192.168.88.1) atau domain DDNS
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'port' => 'required|integer|min:1|max:65535',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function resetForm()
    {
        $this->reset(['name', 'host', 'username', 'password', 'description']);
        $this->port = 8728;
        $this->selectedRouterId = null;
        $this->isEdit = false;
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $this->resetForm();
        $router = Router::findOrFail($id);

        $this->selectedRouterId = $router->id;
        $this->name = $router->name;
        $this->host = $router->host;
        $this->username = $router->username;
        $this->password = $router->password;
        $this->port = $router->port;
        $this->description = $router->description;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        Router::create([
            'tenant_id' => auth()->user()->tenant_id,
            'name' => $this->name,
            'host' => $this->host,
            'username' => $this->username,
            'password' => $this->password,
            'port' => $this->port,
            'description' => $this->description,
        ]);

        $this->showModal = false;
        $this->resetForm();
        $this->dispatch('notify', title: 'Success', message: 'Router registered successfully.');
    }

    public function update()
    {
        $this->validate();

        $router = Router::findOrFail($this->selectedRouterId);
        $router->update([
            'name' => $this->name,
            'host' => $this->host,
            'username' => $this->username,
            'password' => $this->password,
            'port' => $this->port,
            'description' => $this->description,
        ]);

        $this->showModal = false;
        $this->resetForm();
        $this->dispatch('notify', title: 'Success', message: 'Router updated successfully.');
    }

    public function delete($id)
    {
        $router = Router::findOrFail($id);
        $router->delete();

        $this->dispatch('notify', title: 'Deleted', message: 'Router has been removed.');
    }

    public function render()
    {
        return view('livewire.admin.router.router-table', [
            'routers' => Router::latest()->paginate(10)
        ]);
    }
}
