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
        return  $this->belonngsTo(Masjid::class);
    }

    public function createdBy()
    {
        return  $this->belongsTo(User::class, 'created_by');
    }
}
