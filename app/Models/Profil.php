<?php

namespace App\Models;

use App\Traits\ConvertContentImageBase64ToUrl;
use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjidId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjidId, GenerateSlug;
    use ConvertContentImageBase64ToUrl;

    protected $contentName = 'konten';
    protected $guarded = [];

    public function scopeUserMasjid($q)
    {
        return $q->where('masjid_id', auth()->user()->masjid_id);
    }

    public function createdBy()
    {
        return  $this->belongsTo(User::class, 'created_by');
    }
}
