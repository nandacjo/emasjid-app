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

    public function storeProfil($data)
    {
        return Profil::create($data);
    }

    public function findProfil($id)
    {
        return Profil::find($id);
    }

    public function updateProfil($data, $id)
    {
        $profil = Profil::where('id', $id)->first();
        $profil->name = $data['name'];
        $profil->slug = $data['slug'];
        $profil->save();
    }

    public function destroyProfil($id)
    {
        $Profil = Profil::find($id);
        $Profil->delete();
    }
 }
