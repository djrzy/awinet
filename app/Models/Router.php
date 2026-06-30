<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Router extends Model
{
    use HasFactory, BelongsToTenant;

    protected $fillable = [
        'tenant_id',
        'name',
        'host',
        'username',
        'password',
        'port',
        'description',
    ];

    protected $casts = [
        'port' => 'integer',
    ];

    public function setPortAttribute($value)
    {
        $this->attributes['port'] = (int) str_replace([',', '.'], '', $value);
    }

    public function customer_services(): HasMany
    {
        return $this->hasMany(CustomerService::class);
    }
}
