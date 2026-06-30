<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
use App\Models\InternetPlan;
use App\Models\Router;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Services\Network\MikrotikApiService;

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
    public $ip_address;
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
    public array $routers = [];
    public $currentServiceType = null;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        $this->internetPlans = InternetPlan::query()
            ->where('status', true)
            ->where('service_type', '!=', 'hotspot')
            ->orderBy('price')
            ->get(['id', 'name', 'service_type'])
            ->map(function ($plan) {
                return [
                    'id' => $plan->id,
                    'name' => $plan->name,
                    'service_type' => $plan->service_type->label(),
                ];
            })
            ->toArray();

        $this->routers = Router::query()
            ->where('tenant_id', auth()->user()->tenant_id)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedInternetPlanId($value)
    {
        if ($value) {
            $plan = InternetPlan::where('service_type', '!=', 'hotspot')->find($value);
            $this->currentServiceType = $plan ? $plan->service_type->value : null;
        } else {
            $this->currentServiceType = null;
        }

        $this->username = null;
        $this->password = null;
        $this->ip_address = null;
    }

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
            'tenant_id' => auth()->user()->tenant_id,
            'service_name' => $this->service_name,
            'username' => in_array($this->currentServiceType, ['pppoe', 'dedicated']) ? $this->username : null,
            'password' => in_array($this->currentServiceType, ['pppoe', 'dedicated']) ? $this->password : null,
            'ip_address' => in_array($this->currentServiceType, ['static', 'dedicated']) ? $this->ip_address : null,
            'service_type' => $this->currentServiceType, // Memastikan kolom baru di database ikut tersimpan
            'activation_date' => $this->activation_date,
            'expiration_date' => $this->expiration_date,
            'deactivation_date' => $this->deactivation_date,
            'installation_address' => $installationAddress,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'router_id' => $this->router_id ?: null,
            'internet_plan_id' => $this->internet_plan_id,
            'status' => $this->status,
        ];
    }

    public function rules(): array
    {
        return [
            'service_name' => 'required|string|max:255',
            'internet_plan_id' => 'required|integer|exists:internet_plans,id',
            'router_id' => 'nullable|integer|exists:routers,id',
            'similar_address' => 'required|boolean',
            'activation_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after_or_equal:activation_date',
            'deactivation_date' => 'nullable|date|after_or_equal:activation_date',
            'installation_address' => ['required_if:similar_address,0', 'nullable', 'string', 'max:255'],
            'latitude' => 'nullable',
            'longitude' => 'nullable',

            // Validasi Dinamis berbasis tipe paket internet yang dipilih
            'username' => in_array($this->currentServiceType, ['pppoe', 'dedicated']) ? 'required|string|max:255|unique:customer_services,username' : 'nullable',
            'password' => in_array($this->currentServiceType, ['pppoe', 'dedicated']) ? 'required|string|min:4' : 'nullable',
            'ip_address' => in_array($this->currentServiceType, ['static', 'dedicated']) ? 'required|ip' : 'nullable',
        ];
    }

    public function resetForm()
    {
        $this->reset([
            'service_name',
            'username',
            'password',
            'ip_address',
            'activation_date',
            'expiration_date',
            'deactivation_date',
            'installation_address',
            'latitude',
            'longitude',
            'router_id',
            'internet_plan_id',
            'currentServiceType'
        ]);

        $this->status = 'pending';
        $this->similar_address = null;
        $this->selectedService = null;
        $this->statusAction = null;

        $this->dispatch('refresh-map', id: 'create-service-map', clear: true);
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

        $this->dispatch('refresh-map', id: 'create-service-map');
        $this->installation_address = null;
        $this->latitude = null;
        $this->longitude = null;
    }

    public function viewEdit($serviceId)
    {
        $service = $this->customer->services()->findOrFail($serviceId);
        $this->selectedService = $service;

        $this->currentServiceType = $service->internet_plan?->service_type;

        $this->fill([
            'service_name' => $service->service_name,
            'username' => $service->username,
            'password' => $service->password,
            'ip_address' => $service->ip_address,
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

        $this->similar_address = $service->installation_address === $this->customer->address ? 1 : 0;
        $this->modalMode = 'view-edit';
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save(MikrotikApiService $mikrotik)
    {
        $this->validate();

        $plan = InternetPlan::findOrFail($this->internet_plan_id);
        $router = $this->router_id ? Router::find($this->router_id) : null;

        try {
            DB::transaction(function () use ($mikrotik, $plan, $router) {

                // A. Simpan registrasi layanan ke database lokal Laravel
                $service = $this->customer->services()->create($this->formData());

                // B. Jika router dialokasikan, jalankan isolasi provisi otomatis lewat API biner
                if ($router) {

                    if (!$mikrotik->connect($router->host, $router->username, $router->password, $router->port)) {
                        throw new \Exception("Gagal terhubung ke Router API '{$router->name}'. Pastikan service 'api' (Port 8728) di Mikrotik aktif.");
                    }

                    // -----------------------------------------------------------------
                    // JALUR 1: PPPoE RUMAHAN (IP Dinamis via Pool)
                    // -----------------------------------------------------------------
                    if ($this->currentServiceType === 'pppoe') {
                        $result = $mikrotik->comm('/ppp/secret/add', [
                            'name'     => trim($this->username),
                            'password' => trim($this->password),
                            'service'  => 'pppoe',
                            'profile'  => trim($plan->name),
                        ]);

                        $this->checkMikrotikError($result, "pembuatan user PPPoE");
                    }

                    // -----------------------------------------------------------------
                    // JALUR 2: DEDICATED VIA PPPoE (Username + Kunci IP Statis)
                    // -----------------------------------------------------------------
                    elseif ($this->currentServiceType === 'dedicated') {
                        $result = $mikrotik->comm('/ppp/secret/add', [
                            'name'           => trim($this->username),
                            'password'       => trim($this->password),
                            'service'        => 'pppoe',
                            'profile'        => trim($plan->name),
                            'remote-address' => trim($this->ip_address), // Mengunci IP statis pada akun PPP
                        ]);

                        $this->checkMikrotikError($result, "pembuatan user PPPoE Dedicated");
                    }

                    // -----------------------------------------------------------------
                    // JALUR 3: STATIC IP MURNI (Tanpa PPP, langsung batasi via Simple Queue)
                    // -----------------------------------------------------------------
                    elseif ($this->currentServiceType === 'static') {
                        $rateLimitString = $plan->upload_speed . 'M/' . $plan->download_speed . 'M';

                        $result = $mikrotik->comm('/queue/simple/add', [
                            'name'      => 'Static-' . trim($this->customer->user->name ?? $this->service_name),
                            'target'    => trim($this->ip_address), // IP pelanggan target limitasi
                            'max-limit' => $rateLimitString,       // Pembatasan bandwidth langsung (ex: 2M/10M)
                        ]);

                        $this->checkMikrotikError($result, "pendaftaran Simple Queue");
                    }

                    $mikrotik->disconnect();
                }
            });

            $this->closeModal();

            $this->dispatch(
                'notify',
                title: 'Success',
                message: 'Internet service assigned and provisioned via Router API successfully.',
            );
        } catch (\Exception $e) {
            $mikrotik->disconnect();

            $this->dispatch(
                'notify',
                title: 'Provisioning Error',
                message: $e->getMessage(),
                type: 'error'
            );
        }
    }

    /**
     * Helper internal untuk memvalidasi respon error dari library RouterOS API
     */
    private function checkMikrotikError($result, $context)
    {
        if (isset($result['!done']['after']['message'])) {
            throw new \Exception("Mikrotik menolak {$context}: " . $result['!done']['after']['message']);
        }

        if (isset($result['!trap'])) {
            throw new \Exception("Mikrotik menolak {$context}: " . ($result['!trap']['message'] ?? 'Periksa keselarasan parameter konfigurasi Winbox Anda.'));
        }
    }

    public function changePlan($serviceId)
    {
        $service = $this->customer->services()->findOrFail($serviceId);
        $this->selectedService = $service;
        $this->internet_plan_id = $service->internet_plan_id;
        $this->modalMode = 'change-plan';
        $this->showModal = true;
    }

    public function serviceStatus($serviceId, $action)
    {
        $service = $this->customer->services()->findOrFail($serviceId);
        $this->selectedService = $service;
        $this->statusAction = $action;
        $this->modalMode = 'service-status';
        $this->showModal = true;
    }

    public function routerSettings($serviceId)
    {
        $service = $this->customer->services()->findOrFail($serviceId);
        $this->selectedService = $service;
        $this->router_id = $service->router_id;
        $this->username = $service->username;
        $this->password = $service->password;
        $this->ip_address = $service->ip_address;
        $this->currentServiceType = $service->internet_plan?->service_type;

        $this->modalMode = 'router-settings';
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.admin.customer.customer-internet-services');
    }
}
