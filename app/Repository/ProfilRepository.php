<?php


namespace App\Repository;

use App\Repository\Interfaces\ProfilRepositoryInterface;
use App\Models\Profil;


class ProfilRepository implements ProfilRepositoryInterface
{
    public function allProfil()
    {
        return Profil::UserMasjid()->latest()->paginate(50);
    }

    public function storeProfil($request)
    {
        $requestData = $request->validated();
        // $requestData['created_by'] = auth()->user()->id;
        // $requestData['masjid_id'] = auth()->user()->masjid_id;

        return Profil::create($requestData);
    }

    public function findProfil($profil)
    {
        return $profil;
    }

    public function updateProfil($request, $profil)
    {
        $requestData = $request->validated();

        $requestData['created_by'] = auth()->user()->id;
        $requestData['masjid_id'] = auth()->user()->masjid_id;

        $profil->update($requestData);
    }

    public function destroyProfil($profil)
    {
        $profil->delete();
    }
}