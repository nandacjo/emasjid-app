<?php


namespace App\Repository\Interfaces;

Interface ProfilRepositoryInterface{
    public function allProfil();
    public function storeProfil($data);
    public function findProfil($id);
    public function updateProfil($data, $id);
    public function destroyProfil($id);

}
