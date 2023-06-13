<?php

namespace App\Repository;

use App\Models\Bank;
use App\Models\MasjidBank as Model;
use App\Repository\Interfaces\MasjidBankRepositoryInterface;

class MasjidBankRepository implements MasjidBankRepositoryInterface
{
    public function allData()
    {
        return Model::UserMasjid()->latest()->paginate(50);
    }

    public function storeData($request): void
    {
        $requestData = $request->validated();
        $bank = Bank::findOrFail($requestData['bank_id']);
        unset($requestData['bank_id']);
        $requestData['kode_bank'] = $bank->sandi_bank;
        $requestData['nama_bank'] = $bank->nama_bank;

        Model::create($requestData);
    }

    public function findData($data)
    {
        return $data;
    }

    public function updateData($request, $masjid_bank)
    {
        $requestData = $request->validated();
        $bank = Bank::findOrFail($requestData['bank_id']);
        unset($requestData['bank_id']);
        $requestData['kode_bank'] = $bank->sandi_bank;
        $requestData['nama_bank'] = $bank->nama_bank;

        $masjid_bank->update($requestData);
    }

    public function destroyData($data)
    {
        $data->delete();
    }
}
