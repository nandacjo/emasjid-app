<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Http\Requests\StoreProfilRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Repository\Interfaces\ProfilRepositoryInterface;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
  private $profilRepository;

  public function __construct(ProfilRepositoryInterface $profilRepository)
  {
    $this->profilRepository = $profilRepository;
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $models = $this->profilRepository->allProfil();
    $title = 'Profil Masjid';
    return view('profil.index', compact('models', 'title'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $profil = new Profil();
    $listKategori = [
      'visi-misi' => 'Visi Misi',
      'sejarah' => 'Sejarah',
      'struktur-organisasi' => 'Struktur Organisasi'
    ];
    $title = 'Tambah data profil';
    return view('profil.form', compact('profil', 'listKategori', 'title'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreProfilRequest $request)
  {
    $this->profilRepository->storeProfil($request);
    flash('Data sudah disimpan');
    return back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Profil $profil)
  {
    $profil = $this->profilRepository->findProfil($profil);
    $title = 'Detail Profil';
    return view('profil.show', compact('profil', 'title'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Profil $profil)
  {
    $profil = $this->profilRepository->findProfil($profil);
    $listKategori = [
      'visi-misi' => 'Visi Misi',
      'sejarah' => 'Sejarah',
      'struktur-organisasi' => 'Struktur Organisasi'
    ];
    $title = 'Edit data profil';
    return view('profil.form', compact('profil', 'listKategori', 'title'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateProfilRequest $request, Profil $profil)
  {
    $this->profilRepository->updateProfil($request, $profil);
    flash('Data berhasil di update')->success();
    return back();
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Profil $profil)
  {
    $this->profilRepository->destroyProfil($profil);
    flash('Dash sudah dihapus');
    return back();
  }
}
