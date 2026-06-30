<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerService extends Model
{
    protected $fillable = [
        'tenant_id',
        'customer_id',
        'service_name',
        'internet_plan_id',
        'ip_address',
        'username',
        'password',
        'status',
        'activation_date',
        'expiration_date',
        'deactivation_date',
        'router_id',
        'installation_address',
        'latitude',
        'longitude',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function internet_plan()
    {
        return $this->belongsTo(InternetPlan::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function router()
    {
        return $this->belongsTo(Router::class);
    }
}
