<?php

namespace App\Repository;

use App\Models\KurbanHewan;
use App\Models\KurbanPeserta as Model;
use App\Models\Peserta;
use App\Repository\Interfaces\KurbanPesertaRepositoryInterface;
use Illuminate\Support\Facades\DB;

class KurbanPesertaRepository implements KurbanPesertaRepositoryInterface
{
    public function allData()
    {
        return Model::UserMasjid()->latest()->paginate(50);
    }

    public function storeData($request): void
    {
        $requestData = $request->validated();
        $requestDataPeserta = $requestData;

        unset($requestDataPeserta['kurban_hewan_id']);
        unset($requestDataPeserta['status_bayar']);
        unset($requestDataPeserta['total_bayar']);
        unset($requestDataPeserta['tanggal_bayar']);
        unset($requestDataPeserta['kurban_id']);

        DB::beginTransaction();
        $peserta = Peserta::create($requestDataPeserta);
        if ($request->filled('status_bayar')) {
            $kurbanHewan = KurbanHewan::userMasjid()->where("id", $request->kurban_hewan_id)->firstOrFail();
            $dataKurbanPeserta = [
                'kurban_id' => $kurbanHewan->id,
                'kurban_hewan_id' => $kurbanHewan->id,
                'peserta_id' => $peserta->id,
                'total_bayar' => $requestData['total_bayar'],
                'tanggal_bayar' => $requestData['tanggal_bayar'],
                'status_bayar' => 'Lunas', 'metode_bayar' => 'Tunai',
                'bukti_bayar' => 'Ok'
            ];
            Model::create($dataKurbanPeserta);
        }
        DB::commit();
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
