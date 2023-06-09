<?php


namespace App\Repository\Interfaces;

interface KurbanPesertaRepositoryInterface
{
    public function allData();
    public function storeData($data);
    public function findData($id);
    public function updateData($data, $id);
    public function destroyData($id);
}