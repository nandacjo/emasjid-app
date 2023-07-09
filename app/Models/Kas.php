<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
  use HasFactory;
  use HasMasjid, HasCreatedBy;

  protected $table = 'kas';
  protected $guarded = ['id'];

  protected $casts = [
    'tanggal' => 'datetime:d-m-Y H:i:s'
  ];

  // public function masjid()
  // {
  //     return  $this->belongsTo(Masjid::class);
  // }

  // public function createdBy()
  // {
  //     return  $this->belongsTo(User::class, 'created_by');
  // }

  public function scopeSaldoAkhir($query, $masjidId = null)
  {
    // $masjidId = $masjidId ?? auth()->user()->masjid_id;
    // return $query->where('masjid_id', $masjidId)
    //     ->orderBy('created_at', 'desc')
    //     ->value('saldo_akhir') ?? 0;

    $masjidId = $masjidId ?? auth()->user()->masjid_id;
    $masjid = Masjid::where('id', $masjidId)->first();
    return $masjid->saldo_akhir ?? 0;
  }

  // ini sudah di pindahkan ke dalam trait
  // public function scopeUserMasjid($query)
  // {
  //     return $query->where('masjid_id', auth()->user()->masjid_id);
  // }

  public function getRouteKeyName(): string
  {
    return 'id';
  }



  // protected static function booted()
  // {
  //   static::created(function (Kas $kas) {
  //     $saldoAkhir = Kas::SaldoAkhir();
  //     if ($kas->jenis == 'masuk') {
  //       $saldoAkhir += $kas->jumlah;
  //     } else {
  //       $saldoAkhir -= $kas->jumlah;
  //     }
  //     $kas->masjid->update(['saldo_akhir' => $saldoAkhir]);
  //   });

  //   static::deleted(function (Kas $kas) {
  //     $saldoAkhir = Kas::SaldoAkhir();
  //     if ($kas->jenis == 'masuk') {
  //       $saldoAkhir -= $kas->jumlah;
  //     } else {
  //       $saldoAkhir += $kas->jumlah;
  //     }
  //     $kas->masjid->update(['saldo_akhir' => $saldoAkhir]);
  //   });

  //   static::updated(function (Kas $kas) {
  //     $saldoAkhir = Kas::SaldoAkhir();
  //     if ($kas->jenis == 'masuk') {
  //       $saldoAkhir -= $kas->getOriginal('jumlah');
  //       $saldoAkhir += $kas->jumlah;
  //     } else {
  //       $saldoAkhir += $kas->getOriginal('jumlah');
  //       $saldoAkhir -= $kas->jumlah;
  //     }
  //     $kas->masjid->update(['saldo_akhir' => $saldoAkhir]);
  //   });
  // }
}
