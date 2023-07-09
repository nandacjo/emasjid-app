<?php

namespace App\Observers;

use App\Models\Kas;
use App\Models\Infaq;
use Exception;

class InfaqObserver
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
  public function created(Infaq $infaq): void
  {
    // Cek apakah jenis adalah uang, kalau iya maka akan di save di tabel kas
    if ($infaq->jenis == 'uang') {
      try {
        $kas = new Kas();
        $kas->infaq_id = $infaq->id;
        $kas->tanggal = $infaq->created_at;
        $kas->kategori = 'infaq-' . $infaq->sumber;
        $kas->keterangan = 'Infaq ' . $infaq->sumber . ' dari ' . $infaq->atas_nama;
        $kas->jenis = 'masuk';
        $kas->jumlah = $infaq->jumlah;
        $kas->saldo = auth()->user()->masjid->saldo_akhir + $infaq->jumlah;
        $kas->save();
      } catch (\Throwable $th) {
        throw new Exception('Error, data gagal disimpan! ' . $th->getMessage());
      }
    }
  }

  /**
   * Handle the infaq "updated" event.
   */
  public function updated(Infaq $infaq): void
  {
    if ($infaq->jenis == 'uang') {
      try {
        $kas = $infaq->kas;
        $kas->jumlah = $infaq->jumlah;
        $saldo_akhir = auth()->user()->masjid->saldo_akhir - $kas->getOriginal('jumlah');
        $kas->saldo = $saldo_akhir + $infaq->jumlah;
        $kas->save();
      } catch (\Throwable $th) {
        throw new Exception('Error, data gagal disimpan! ' . $th->getMessage());
      }
    }
  }

  /**
   * Handle the infaq "deleted" event.
   */
  public function deleted(infaq $infaq): void
  {
    if ($infaq->kas != null) {
      try {
        $infaq->kas->delete();
      } catch (\Throwable $th) {
        throw new Exception('Error, ' . $th->getMessage());
      }
    }
  }

  /**
   * Handle the infaq "restored" event.
   */
  public function restored(Infaq $infaq): void
  {
    //
  }

  /**
   * Handle the infaq "force deleted" event.
   */
  public function forceDeleted(Infaq $infaq): void
  {
    //
  }
}
