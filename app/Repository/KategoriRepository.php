<?php


namespace App\Repository;

use App\Models\Kategori;
use App\Repository\Interfaces\KategoriRepositoryInterface;
use App\Traits\HasCreatedBy;
use App\Traits\HasMasjid;

class KategoriRepository implements KategoriRepositoryInterface
{
    public function allKategori()
    {
        return Kategori::UserMasjid()->latest()->paginate(50);
    }

    public function storeKategori($request): void
    {
        $requestData = $request->validated();
        Kategori::create($requestData);
    }

    public function findKategori($Kategori)
    {
        return $Kategori;
    }

    public function updateKategori($request, $Kategori)
    {
        $requestData = $request->validated();

        $requestData['created_by'] = auth()->user()->id;
        $requestData['masjid_id'] = auth()->user()->masjid_id;

        $Kategori->update($requestData);
    }

    public function destroyKategori($kategori)
    {
        $kategori->delete();
    }
}
