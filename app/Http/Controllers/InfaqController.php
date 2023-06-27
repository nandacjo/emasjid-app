<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInfaqRequest;
use App\Http\Requests\UpdateInfaqRequest;
use App\Models\Infaq as Model;
use App\Models\Infaq;
use App\Models\Kas;
use DB;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class InfaqController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $query = Model::UserMasjid()
      ->when($request->filled('q'), fn ($query) => $query->where('keterangan', 'LIKE', '%' . $request->q . '%'))
      ->when($request->filled('tanggal_mulai'), fn ($query) => $query->whereDate('created_at', '>=', $request->tanggal_mulai))
      ->when($request->filled('tanggal_selesai'), fn ($query) => $query->whereDate('created_at', '<=', $request->tanggal_selesai))
      ->latest()
      ->paginate(50);

    if ($request->page == "laporan") {
      // return view('kas.kas_laporan', compact('kas', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran'));
    }

    return view('infaq.index', compact('query'));
  }

  private function listSumberDana()
  {
    return [
      'kotak-amal-jumat' => 'Kotak Amal Jumat',
      'instansi' => 'Instansi',
      'perorang' => 'Per-orangan',
      'lainnya' => 'Lainnya'
    ];
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $data['model'] = new Infaq();
    $data['title'] = 'Tambah Data Infaq';
    $data['listSumberDana'] = $this->listSumberDana();
    return view('infaq.form', $data);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreInfaqRequest $request)
  {
    $requestData = $request->validated();
    // Cek apakah ada request->atas_nama kalau tidak maka nilai defaultnya adalah Hamba Allah
    $requestData['atas_nama'] = $requestData['atas_nama'] ?? 'Hamba Allah';
    // Save data infaq ket table infaw mesjid
    DB::beginTransaction();
    $infaq = Infaq::create($requestData);

    // Cek apakah jenis adalah uang, kalau iya maka akan di save di tabel kas
    if ($infaq->jenis == 'uang') {
      $kas = new Kas();
      $kas->masjid_id = $request->user()->masjid_id;
      $kas->tanggal = $infaq->created_at;
      $kas->kategori = 'infaq-' . $infaq->sumber;
      $kas->keterangan = 'Infaq ' . $infaq->sumber . ' dari ' . $infaq->atas_nama;
      $kas->jenis = 'masuk';
      $kas->jumlah = $infaq->jumlah;
      $kas->save();
    }
    DB::commit();

    flash('Data infaq berhasil disimpan dan tersimpan di kas mesjid');
    return back();
  }

  /**
   * Display the specified resource.
   */
  public function show(Infaq $infaq)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Infaq $infaq)
  {
    $data['model'] = Infaq::UserMasjid()->findOrFail($infaq->id);
    $data['title'] = 'Edit Data Infaq';
    $data['listSumberDana'] = $this->listSumberDana();
    return view('infaq.form', $data);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateInfaqRequest $request, Infaq $infaq)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Infaq $infaq)
  {
    //
  }
}
