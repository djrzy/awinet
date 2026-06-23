<?php

namespace App\Models;

use App\Enums\InternetPlan\InternetServiceType;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternetPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'name',
        'description',
        'download_speed',
        'upload_speed',
        'service_type',
        'price',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'service_type' => InternetServiceType::class,
        ];
    }

    protected function priceFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => rupiah($this->price)
        );
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function services()
    {
        return $this->hasMany(CustomerService::class);
    }
}
