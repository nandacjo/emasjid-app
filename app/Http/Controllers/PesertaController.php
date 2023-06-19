<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKurbanRequest;
use App\Http\Requests\UpdateKurbanRequest;
use App\Models\Peserta as Model;
use App\Models\Kurban;
use App\Repository\Interfaces\PesertaRepositoryInterface;

class PesertaController extends Controller
{
    private $pesertaRepository;

    public function __construct(PesertaRepositoryInterface $pesertaRepository)
    {
        $this->pesertaRepository = $pesertaRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $model = $this->pesertaRepository->allData();
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
        $title = 'Tambah informasi peserta kurban';

        return view('peserta.form', compact('model', 'title', 'kurban'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKurbanRequest $request)
    {
        $this->pesertaRepository->storeData($request);
        flash('Data sudah disimpan');
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
        $model = $this->pesertaRepository->findData($kurban);
        $title = "Edit informasi kurban";
        return view('kurban.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurbanRequest $request, Model $kurban)
    {
        $this->pesertaRepository->updateData($request, $kurban);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Model $kurban)
    {
        $this->pesertaRepository->destroyData($kurban);
        flash('Data sudah dihapus');
        return back();
    }
}
