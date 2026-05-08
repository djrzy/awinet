<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{

    use HasFactory, SoftDeletes;

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
}
