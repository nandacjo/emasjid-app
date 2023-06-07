<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInformasiRequest;
use App\Http\Requests\UpdateInformasiRequest;
use App\Models\Informasi;
use App\Models\Kategori;
use App\Repository\Interfaces\InformasiRepositoryInterface;

class InformasiController extends Controller
{
    private $informasiRepository;

    public function __construct(InformasiRepositoryInterface $informasiRepository)
    {
        $this->informasiRepository = $informasiRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = $this->informasiRepository->allInformasi();
        $title = 'Informasi';
        return view('informasi.index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Informasi();
        $listKategori = Kategori::pluck('nama', 'id');
        $title = 'Tambah informasi baru';
        return view('informasi.form', compact('model', 'listKategori', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInformasiRequest $request)
    {
        $this->informasiRepository->storeInformasi($request);
        flash('Data sudah disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        $model = $this->informasiRepository->findInformasi($informasi);
        $title = 'Detail Informasi';
        return view('informasi.show', compact('model', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        $model = $this->informasiRepository->findInformasi($informasi);
        $listKategori = Kategori::pluck('nama', 'id');
        $title = 'Edit Informasi';
        return view('informasi.form', compact('model', 'listKategori', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInformasiRequest $request, Informasi $informasi)
    {
        $this->informasiRepository->updateInformasi($request, $informasi);
        flash('Data berhasil di update')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $this->informasiRepository->destroyInformasi($informasi);
        flash('Data sudah dihapus');
        return back();
    }
}
