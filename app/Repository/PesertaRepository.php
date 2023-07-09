<?php

namespace App\Repository;

use App\Models\Kurban;
use App\Models\Peserta as Model;
use App\Repository\Interfaces\PesertaRepositoryInterface;

class PesertaRepository implements PesertaRepositoryInterface
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

  public function findUserMasjid()
  {
    $kurban = Kurban::userMasjid()->where('id', request('kurban_id'))->firstOrFail();
    return $kurban;
  }
}
