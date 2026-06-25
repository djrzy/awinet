<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait BelongsToTenant
{
    public static function bootBelongsToTenant()
    {
        // 1. Otomatis mengisi tenant_id saat data baru dibuat (di-create)
        static::creating(function (Model $model) {
            if (auth()->check() && auth()->user()->tenant_id) {
                $model->tenant_id = auth()->user()->tenant_id;
            }
        });

        // 2. Otomatis menyaring semua kueri SQL berdasarkan tenant_id dengan nama tabel yang jelas
        static::addGlobalScope('tenant', function (Builder $builder) {
            if (auth()->check()) {
                if (auth()->user()->tenant_id) {
                    // MENDAPATKAN NAMA TABEL SECARA DINAMIS (cth: customers.tenant_id atau internet_plans.tenant_id)
                    $builder->where($builder->getModel()->getTable() . '.tenant_id', auth()->user()->tenant_id);
                }
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(\App\Models\Tenant::class);
    }
}
