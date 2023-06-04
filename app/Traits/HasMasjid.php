<?php

namespace App\Traits;

use App\Models\User;

trait HasMasjid
{
    protected static function bootHasMasjidId()
    {
        static::creating(function ($model) {
            $model->masjid_id = auth()->user()->masjid_id;
        });
    }

    public function scopeUserMasjid($q)
    {
        return $q->where('masjid_id', auth()->user()->masjid_id);
    }

    public function createdBy()
    {
        return  $this->belongsTo(User::class, 'created_by');
    }
}
