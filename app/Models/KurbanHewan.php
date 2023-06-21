<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KurbanHewan extends Model
{
  use HasFactory;
  use HasMasjid, HasCreatedBy, HasCreatedBy;

  protected $guarded = [];
  protected $appends = ['nama_full'];

  public function getNamaFullAttribute()
  {
    return ucwords($this->hewan) . " - {$this->kriteria} - " . formatRupiah($this->iuran_perorang, true);
  }

  /**
   * Get the kurban that owns the KurbanHewan
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function kurban(): BelongsTo
  {
    return $this->belongsTo(Kurban::class);
  }

  public function kurbanPeserta(): HasMany
  {
    return $this->hasMany(KurbanPeserta::class);
  }



  // mencek dua kondisi di model binding slug dan masjid_id
  public function resolveRouteBinding($value, $field = null)
  {
    return $this->where('masjid_id', auth()->user()->masjid_id)
      ->where('id', $value)->firstOrFail();
  }
}
