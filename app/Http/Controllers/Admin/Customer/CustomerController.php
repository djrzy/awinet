<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function show(Customer $customer)
    {
        return view('pages.admin.customer.show', [
            'customer' => $customer
        ]);
    }
}
