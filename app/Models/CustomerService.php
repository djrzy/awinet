<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerService extends Model
{
    protected $fillable = [
        'tenant_id',
        'customer_id',
        'internet_plan_id',
        'username',
        'password',
        'status',
        'activation_date',
        'expiration_date',
        'deactivation_date',
        'router_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function internet_plan()
    {
        return $this->belongsTo(InternetPlan::class);
    }
}
