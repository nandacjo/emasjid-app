<?php

namespace App\Repository;

use App\Http\Requests\StoreKurbanPesertaRequest;
use App\Http\Requests\StorePesertaRequest;
use App\Models\KurbanHewan;
use App\Models\KurbanPeserta as Model;
use App\Models\Peserta;
use App\Repository\Interfaces\KurbanPesertaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KurbanPesertaRepository implements KurbanPesertaRepositoryInterface
{
  public function allData()
  {
    return Model::UserMasjid()->latest()->paginate(50);
  }


  public function storeData($request): void
  {
    $requestPeserta = $request[1]->validated();

    DB::beginTransaction();
    $peserta = Peserta::create($requestPeserta);
    $statusBayar = 'belum';
    if ($request[0]->filled('status_bayar')) {
      $statusBayar = 'lunas';
    }
    $requestKurbanPeserta = $request[0]->validated();
    $kurbanHewan = KurbanHewan::userMasjid()->where("id", $request[0]->kurban_hewan_id)->firstOrFail();
    $requestKurbanPeserta['total_bayar'] = $requestKurbanPeserta['total_bayar'] ?? $kurbanHewan->iuran_perorang;
    $dataKurbanPeserta = [
      'kurban_id' => $kurbanHewan->kurban_id,
      'kurban_hewan_id' => $kurbanHewan->id,
      'peserta_id' => $peserta->id,
      'total_bayar' => $requestKurbanPeserta['total_bayar'],
      'tanggal_bayar' => $requestKurbanPeserta['tanggal_bayar'],
      'status_bayar' => strtolower($statusBayar),
      'metode_bayar' => 'Tunai',
      'bukti_bayar' => 'Ok'
    ];
    Model::create($dataKurbanPeserta);
    DB::commit();
  }

  public function findData($data)
  {
    return $data;
  }

  public function updateData($request, $kurban)
  {
    $requestData = $request->validated();
    $iuranPerorang = $kurban->kurbanHewan->iuran_perorang;
    $totalBayar = $requestData['total_bayar'];
    if ($iuranPerorang > $totalBayar) {
      return false;
    }
    $kurban->status_bayar = 'lunas';
    $kurban->update($requestData);
    return true;
  }

  public function destroyData($data)
  {
    if ($data->status_bayar == 'Lunas') {
      return false;
    } else {
      $data->delete();
      return true;
    }
  }
}
