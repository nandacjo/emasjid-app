<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKurbanHewanRequest;
use App\Http\Requests\UpdateKurbanHewanRequest;
use App\Models\Kurban;
use App\Models\KurbanHewan as Model;
use App\Repository\Interfaces\KurbanHewanRepositoryInterface;

class KurbanHewanController extends Controller
{

  private $kurbanHewanRepository;

  public function __construct(KurbanHewanRepositoryInterface $kurbanHewanRepository)
  {
    $this->kurbanHewanRepository = $kurbanHewanRepository;
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $model = new Model();
    $kurban = Kurban::userMasjid()->where('id', request('kurban_id'))->firstOrFail();
    $title = 'Tambah informasi hewan kurban';

    return view('kurbanhewan.form', compact([
      'model',
      'title',
      'kurban',
    ]));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreKurbanHewanRequest $request)
  {
    $this->kurbanHewanRepository->storeData($request);
    flash('Data berhasil sudah disimpan');
    return back();
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Model $kurbanHewan)
  {
    $model = $kurbanHewan;
    $kurban = Kurban::userMasjid()->where('id', request('kurban_id'))->firstOrFail();
    $title = 'Ubah informasi hewan kurban';
    return view('kurbanhewan.form', compact('model', 'title', 'kurban'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateKurbanHewanRequest $request, Model $kurbanHewan)
  {
    $this->kurbanHewanRepository->updateData($request, $kurbanHewan);
    flash('Data sudah disimpan');
    return back();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Model $kurbanHewan)
  {
    Kurban::userMasjid()->where('id', request('kurban_id'))->firstOrFail();
    if ($this->kurbanHewanRepository->destroyData($kurbanHewan) === true) {
      flash('Data berhasil dihapus')->success();
      return back();
    }
    flash('Data gagal dihapus, karena sudah digunakan peserta')->error();
    return back();
  }
}
