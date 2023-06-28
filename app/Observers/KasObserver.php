<?php

namespace App\Observers;

use App\Models\Kas;

class KasObserver
{

  /**
   * Handle events after all transactions are committed.
   *
   * @var bool
   */
  public $afterCommit = true;

  /**
   * Handle the Kas "created" event.
   */
  public function created(Kas $kas): void
  {
    $saldoAkhir = Kas::SaldoAkhir();
    if ($kas->jenis == 'masuk') {
      $saldoAkhir += $kas->jumlah;
    } else {
      $saldoAkhir -= $kas->jumlah;
    }
    $kas->masjid->update(['saldo_akhir' => $saldoAkhir]);
  }

  /**
   * Handle the Kas "updated" event.
   */
  public function updated(Kas $kas): void
  {
    $saldoAkhir = Kas::SaldoAkhir();
    if ($kas->jenis == 'masuk') {
      $saldoAkhir -= $kas->getOriginal('jumlah');
      $saldoAkhir += $kas->jumlah;
    } else {
      $saldoAkhir += $kas->getOriginal('jumlah');
      $saldoAkhir -= $kas->jumlah;
    }
    $kas->masjid->update(['saldo_akhir' => $saldoAkhir]);
  }

  /**
   * Handle the Kas "deleted" event.
   */
  public function deleted(Kas $kas): void
  {
    $saldoAkhir = Kas::SaldoAkhir();
    if ($kas->jenis == 'masuk') {
      $saldoAkhir -= $kas->jumlah;
    } else {
      $saldoAkhir += $kas->jumlah;
    }
    $kas->masjid->update(['saldo_akhir' => $saldoAkhir]);
  }

  /**
   * Handle the Kas "restored" event.
   */
  public function restored(Kas $kas): void
  {
    //
  }

  /**
   * Handle the Kas "force deleted" event.
   */
  public function forceDeleted(Kas $kas): void
  {
    //
  }
}
