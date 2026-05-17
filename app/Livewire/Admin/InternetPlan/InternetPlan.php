<?php

namespace App\Livewire\Admin\InternetPlan;

use App\Models\InternetPlan as Model;
use Livewire\Component;
use Livewire\WithPagination;

class InternetPlan extends Component
{
    use WithPagination;



    public function render()
    {
        $plans = Model::get();

        return view(
            'livewire.admin.internet-plan.internet-plan',
            [
                'plans' => $plans
            ]
        );
    }
}
