<?php

namespace App\Models;

use App\Models\Customer;
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
        'price',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
