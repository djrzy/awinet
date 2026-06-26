<?php

namespace App\Livewire\Admin\Setting;

use App\Models\BillingCycle;
use Carbon\Carbon;
use Livewire\Component;

class BillingCycleForm extends Component
{

    public $billing_type = 'anniversary';
    public $billing_date;
    public $due_date = ''; // Default tempo 7 hari
    public $grace_period = ''; // Default masa tenggang 3 hari

    public function mount()
    {
        // Jika tenant sudah pernah mengisi sebelumnya, langsung isi formnya (untuk edit)
        $existing = BillingCycle::where('tenant_id', auth()->user()->tenant_id)->first();

        if ($existing) {
            $this->billing_type = $existing->billing_type;
            $this->billing_date = $existing->billing_date;
            // Jika due_date disimpan sebagai format tanggal atau interval integer, sesuaikan penampilannya
            $this->due_date = is_numeric($existing->due_date) ? $existing->due_date : Carbon::parse($existing->due_date)->day;
            $this->grace_period = $existing->grace_period;
        }
    }

    public function rules()
    {
        return [
            'billing_type' => 'required|in:fixed,anniversary',
            'billing_date' => 'required_if:billing_type,fixed|nullable',
            'due_date' => 'required|integer|min:1',
            'grace_period' => 'required|integer|min:0',
        ];
    }

    public function save()
    {
        $this->validate();


        BillingCycle::updateOrCreate(
            ['tenant_id' => auth()->user()->tenant_id],
            [
                'billing_type' => $this->billing_type,
                'billing_date' => $this->billing_type === 'fixed' ? $this->billing_date : null,
                'due_date' => $this->due_date,
                'grace_period' => $this->grace_period,
            ]
        );

        $this->dispatch(
            'notify',
            title: 'Success',
            message: 'Your billing cycles has been updated.',
        );
    }

    public function render()
    {
        return view('livewire.admin.setting.billing-cycle-form');
    }
}
