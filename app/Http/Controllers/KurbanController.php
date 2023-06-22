<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKurbanRequest;
use App\Http\Requests\UpdateKurbanRequest;
use App\Models\Kurban as Model;
use App\Repository\Interfaces\KurbanRepositoryInterface;
use Illuminate\Http\Request;

class KurbanController extends Controller
{
  private $kurbanRepository;

  public function __construct(KurbanRepositoryInterface $kurbanRepository)
  {
    $this->kurbanRepository = $kurbanRepository;
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $model = $this->kurbanRepository->allData();
    $title = 'Informasi Kurban';
    return view('kurban.index', compact('model', 'title'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $model = new Model();
    $title = 'Tambah informasi kurban';

    return view('kurban.form', compact('model', 'title'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreKurbanRequest $request)
  {
    $this->kurbanRepository->storeData($request);
    flash('Data sudah disimpan');
    return back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, Model $kurban)
  {
    $model = $kurban;
    $title = 'Detail kurban';
    if ($request->output == 'laporan') {
      $title = 'Laporan kurban';
      return view('kurban.laporan', compact('model', 'title'));
    }
    return view('kurban.show', compact('model', 'title'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Model $kurban)
  {
    $model = $this->kurbanRepository->findData($kurban);
    $title = "Edit informasi kurban";
    return view('kurban.form', compact('model', 'title'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateKurbanRequest $request, Model $kurban)
  {
    $this->kurbanRepository->updateData($request, $kurban);
    flash('Data sudah disimpan');
    return back();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Model $kurban)
  {
    if ($kurban->kurbanHewan->count() >= 1) {
      flash('Data tidak bisa dihapus karena sudah digunakan di tabel lian');
      return back();
    }

    if ($kurban->kurbanPeserta()->count() >= 1) {
      flash('Data tidak bisa dihapus karena sudah digunakan di tabel lian');
      return back();
    }
    $this->kurbanRepository->destroyData($kurban);
    flash('Data sudah dihapus');
    return back();
  }
}
