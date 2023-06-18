<?php

namespace App\Models;

use App\Traits\ConvertContentImageBase64ToUrl;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kurban extends Model
{
    use HasFactory;
    use HasMasjid, HasCreatedBy, ConvertContentImageBase64ToUrl;

    protected $contentName = 'konten';
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_akhir_pendaftaran' => 'date'
    ];

    /**
     * Get all of the hewankurban for the Kurban
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hewanKurban(): HasMany
    {
        return $this->hasMany(KurbanHewan::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('masjid_id', auth()->user()->masjid_id)
            ->where('id', $value)->firstOrFail();
    }

    // protected $dates = [
    //     'tanggal_akhir_pendaftaran',
    // ];


    // protected function serializeDate(\DateTimeInterface $date)
    // {
    //     return $date->format('Y-m-d');
    // }
}
