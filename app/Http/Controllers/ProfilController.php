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
        $profil = $this->profilRepository->allProfil();
        return view('profil.index', compact('profil'));
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
        return view('profil.form', compact('profil', 'listKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'konten' => 'required'
        ]);

        $konten = $requestData['konten']; // mendapakan nilai konte

        // dd($konten);
        // Mencocokkan semua gambar yang terdapat dalam konten menggunkana regular expression


        $requestData['created_by'] = auth()->user()->id;
        $requestData['masjid_id'] = auth()->user()->masjid_id;
        $requestData['slug'] = Str::slug($request->judul);
        $this->profilRepository->storeProfil($requestData);
        flash('Data suda disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profil $profil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profil $profil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfilRequest $request, Profil $profil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profil)
    {
        //
    }
}
