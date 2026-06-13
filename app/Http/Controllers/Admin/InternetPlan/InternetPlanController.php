<?php

namespace App\Http\Controllers\Admin\InternetPlan;

use App\Http\Controllers\Controller;

class InternetPlanController extends Controller
{
    public function show()
    {
        return view('pages.admin.internet-plan.index');
    }
}
