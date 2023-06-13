<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMasjidBankRequest;
use App\Http\Requests\UpdateMasjidBankRequest;
use App\Models\Bank;
use App\Models\MasjidBank;
use App\Repository\Interfaces\MasjidBankRepositoryInterface;

class MasjidBankController extends Controller
{
    private $masjidBankRepository;

    public function __construct(MasjidBankRepositoryInterface $masjidBankRepository)
    {
        $this->masjidBankRepository = $masjidBankRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = $this->masjidBankRepository->allData();
        $title = 'Informasi bank';
        return view('masjid_bank.index', compact('models', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $models = new MasjidBank();
        $title = 'Tambah data bank';
        $listBank = Bank::pluck('nama_bank', 'id');

        return view('masjid_bank.form', compact('models', 'title', 'listBank'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMasjidBankRequest $request)
    {
        $this->masjidBankRepository->storeData($request);
        flash('Data berhasil disimpan');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasjidBank $masjid_bank)
    {
        $models = $masjid_bank;
        $title = 'Tambah data bank';
        $listBank = Bank::pluck('nama_bank', 'id');
        $bankSelect = Bank::where("nama_bank", $models->nama_bank)->pluck('id');

        return view('masjid_bank.form', compact('models', 'title', 'listBank', 'bankSelect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMasjidBankRequest $request, MasjidBank $masjid_bank)
    {
        $this->masjidBankRepository->updateData($request, $masjid_bank);
        flash('Data berhasil di update')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasjidBank $masjid_bank)
    {
        $this->masjidBankRepository->destroyData($masjid_bank);
        flash('Dash sudah dihapus');
        return back();
    }
}
