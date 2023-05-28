<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    protected $table = 'kas';
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal' => 'datetime'
    ];

    public function masjid()
    {
        return  $this->belongsTo(Masjid::class);
    }

    public function createdBy()
    {
        return  $this->belongsTo(User::class, 'created_by');
    }

    public function scopeSaldoAkhir($query, $masjidId = null)
    {
        $masjidId = $masjidId ?? auth()->user()->masjid_id;
        return $query->where('masjid_id', $masjidId)
            ->orderBy('created_at', 'desc')
            ->value('saldo_akhir') ?? 0;
    }

    public function scopeUserMasjid($query)
    {
        return $query->where('masjid_id', auth()->user()->masjid_id);
    }

    public function getRouteKeyName(): string
    {
        return 'id';
    }
}
