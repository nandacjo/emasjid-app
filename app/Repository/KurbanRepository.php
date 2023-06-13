<?php

namespace App\Repository;

use App\Models\Bank;
use App\Models\Kurban as Model;
use App\Repository\Interfaces\KurbanRepositoryInterface;

class KurbanRepository implements KurbanRepositoryInterface
{
    public function allData()
    {
        return Model::UserMasjid()->latest()->paginate(50);
    }

    public function storeData($request): void
    {
        $requestData = $request->validated();
        Model::create($requestData);
    }

    public function findData($data)
    {
        return $data;
    }

    public function updateData($request, $kurban)
    {
        $requestData = $request->validated();
        $kurban->update($requestData);
    }

    public function destroyData($data)
    {
        $data->delete();
    }
}
