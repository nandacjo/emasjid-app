<?php

namespace App\Traits;

use App\Models\Masjid;
use App\Models\User;
use App\Models\Kategori;

trait HasMasjid
{
    // function ini otomatis ini akan di jalankan dan mengisi masjid id
    protected static function bootHasMasjid()
    {
        static::creating(function ($model) {
            $model->masjid_id = auth()->user()->masjid_id;
        });
    }

    // function scope masjid
    public function scopeUserMasjid($q)
    {
        return $q->where('masjid_id', auth()->user()->masjid_id);
    }

    // relasi ke tabel user
    public function createdBy()
    {
        return  $this->belongsTo(User::class, 'created_by');
    }

    // relasi ke table masjid
    public function masjid()
    {
        return  $this->belongsTo(Masjid::class, 'masjid_id');
    }

    // relasi ke tabel kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    // mengganti route key banding menjadi slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // mencek dua kondisi di model binding slug dan masjid_id
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('masjid_id', auth()->user()->masjid_id)
            ->where('slug', $value)->firstOrFail();
    }
}
