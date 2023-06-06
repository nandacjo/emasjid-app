<?php


namespace App\Repository\Interfaces;

interface KategoriRepositoryInterface
{
    public function allKategori();
    public function storeKategori($data);
    public function findKategori($id);
    public function updateKategori($data, $id);
    public function destroyKategori($id);
}