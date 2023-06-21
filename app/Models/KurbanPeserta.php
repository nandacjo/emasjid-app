<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KurbanPeserta extends Model
{
  use HasFactory;
  use HasMasjid, HasCreatedBy;

  protected $guarded = [];

  public function peserta()
  {
    return $this->belongsTo(Peserta::class);
  }

  public function kurbanHewan()
  {
    return $this->belongsTo(KurbanHewan::class);
  }

  // mencek dua kondisi di model binding slug dan masjid_id
  public function resolveRouteBinding($value, $field = null)
  {
    return $this->where('masjid_id', auth()->user()->masjid_id)
      ->where('id', $value)->firstOrFail();
  }
}
