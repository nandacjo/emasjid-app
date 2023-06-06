<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\Kategori;
use App\Repository\Interfaces\KategoriRepositoryInterface;

class KategoriController extends Controller
{
    private $kategoriRepository;

    public function __construct(KategoriRepositoryInterface $kategoriRepository)
    {
        $this->kategoriRepository = $kategoriRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = $this->kategoriRepository->allKategori();
        $title = 'Kategori Masjid';
        return view('kategori.index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Kategori();
        $title = 'Tambah data kategori';
        return view('kategori.form', compact('model', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriRequest $request)
    {
        $this->kategoriRepository->storeKategori($request);
        flash('Data sudah disimpan');
        return back();
    }
    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $model = $kategori;
        $title = 'Edit Kategori';
        return view('kategori.form', compact('model', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $this->kategoriRepository->updateKategori($request, $kategori);
        flash('Data berhasil di update')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
