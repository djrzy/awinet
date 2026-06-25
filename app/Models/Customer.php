<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Override;

class Customer extends Model
{

    use HasFactory, SoftDeletes, BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'internet_plans_id',
        'customer_code',
        'nik',
        'address',
        'postal_code',
        'longitude',
        'latitude',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(CustomerService::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    #[Override]
    public function getRouteKeyName(): string
    {
        return 'customer_code';
    }
}
