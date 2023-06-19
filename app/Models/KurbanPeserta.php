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
}
