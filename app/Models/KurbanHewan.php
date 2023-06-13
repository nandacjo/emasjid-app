<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KurbanHewan extends Model
{
    use HasFactory;
    use HasMasjid, HasCreatedBy;

    protected $guarded = [];

    /**
     * Get the kurban that owns the KurbanHewan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kurban(): BelongsTo
    {
        return $this->belongsTo(Kurban::class);
    }
}
