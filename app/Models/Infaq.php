<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infaq extends Model
{
  use HasFactory, HasCreatedBy, HasMasjid;

  protected $guarded = ['id'];

  public function resolveRouteBinding($value, $field = null)
  {
    return $this->where('masjid_id', auth()->user()->masjid_id)
      ->where('id', $value)->firstOrFail();
  }
}
