<?php

namespace App\Http\Controllers\Admin\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function billing_cycle()
    {
        return view('pages.admin.settings.billing-cycle');
    }
}
