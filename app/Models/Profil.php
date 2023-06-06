<?php

namespace App\Models;

use App\Traits\ConvertContentImageBase64ToUrl;
use App\Traits\GenerateSlug;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;
    use HasCreatedBy, HasMasjid, GenerateSlug;
    use ConvertContentImageBase64ToUrl;

    protected $contentName = 'konten';
    protected $guarded = ['id'];

    // function scoperUserMasjid sudah di pindahkan ke trait hasmasjid
    // public function scopeUserMasjid($q)
    // {
    //     return $q->where('masjid_id', auth()->user()->masjid_id);
    // }

    // relasi belongsto sudah dipindahkan ke trait
    // public function createdBy()
    // {
    //     return  $this->belongsTo(User::class, 'created_by');
    // }
}
