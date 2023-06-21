<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKurbanPesertaRequest;
use App\Http\Requests\StorePesertaRequest;
use App\Http\Requests\UpdateKurbanRequest;
use App\Models\KurbanPeserta as Model;
use App\Models\Kurban;
use App\Repository\Interfaces\KurbanPesertaRepositoryInterface;

class KurbanPesertaController extends Controller
{
    private $kurbanPesertaRepository;

    public function __construct(KurbanPesertaRepositoryInterface $kurbanPesertaRepository)
    {
        $this->kurbanPesertaRepository = $kurbanPesertaRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = $this->kurbanPesertaRepository->allData();
        $title = 'Informasi Kurban';
        return view('kurban.index', compact('model', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Model();
        $kurban = Kurban::userMasjid()->where('id', request('kurban_id'))->firstOrFail();
        $listHewanKurban = $kurban->hewanKurban->pluck('nama_full', 'id');
        $title = 'Tambah informasi peserta kurban';

        return view('kurbanpeserta.form', compact([
            'model', 'title', 'kurban',
            'listHewanKurban'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurbanPesertaRequest $requestKurbanPeserta, StorePesertaRequest $requestPeserta)
    {
        $this->kurbanPesertaRepository->storeData([$requestKurbanPeserta, $requestPeserta]);
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Model $kurban)
    {
        $model = $kurban;
        $title = 'Detail kurban';
        return view('kurban.show', compact('model', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Model $kurban)
    {
        $model = $this->kurbanPesertaRepository->findData($kurban);
        $title = "Edit informasi kurban";
        return view('kurban.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanRequest $request, Model $kurban)
    {
        $this->kurbanPesertaRepository->updateData($request, $kurban);
        flash('Data berhasil diupdate');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Model $kurban_pesertum)
    {
        if ($this->kurbanPesertaRepository->destroyData($kurban_pesertum)) {
            flash('Data sudah dihapus');
            return back();
        } else {
            flash('Data tidak dapat dihapus karena sudah lunas')->warning();
            return back();
        }
    }
}
