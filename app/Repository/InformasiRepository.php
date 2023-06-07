<?php

namespace App\Repository;

use App\Models\Informasi;
use App\Repository\Interfaces\InformasiRepositoryInterface;

class InformasiRepository implements InformasiRepositoryInterface
{
    public function allInformasi()
    {
        return Informasi::UserMasjid()->latest()->paginate(50);
    }

    public function storeInformasi($request): void
    {
        $requestData = $request->validated();
        Informasi::create($requestData);
    }

    public function findInformasi($Informasi)
    {
        return $Informasi;
    }

    public function updateInformasi($request, $informasi)
    {
        $requestData = $request->validated();
        $informasi->update($requestData);
    }

    public function destroyInformasi($informasi)
    {
        $informasi->delete();
    }
}
