<?php

namespace App\Traits;

trait HasMasjidId
{
    protected static function bootHasMasjidId()
    {
        static::creating(function ($model) {
            $model->masjid_id = auth()->user()->masjid_id;
        });
    }
}
