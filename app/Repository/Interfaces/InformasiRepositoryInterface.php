<?php


namespace App\Repository\Interfaces;

interface InformasiRepositoryInterface
{
    public function allInformasi();
    public function storeInformasi($data);
    public function findInformasi($id);
    public function updateInformasi($data, $slug);
    public function destroyInformasi($id);
}
