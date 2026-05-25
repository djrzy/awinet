<?php

namespace App\Http\Controllers\Admin\InternetPlan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InternetPlanController extends Controller
{
    public function show()
    {
        return view('pages.admin.internet-plan.index');
    }

    public function assign()
    {
        return view('pages.admin.internet-plan.assign');
    }
}
