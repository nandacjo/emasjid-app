<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KasController extends Controller
{
  public function index(Request $request)
  {
    $query = Kas::UserMasjid();

    if ($request->filled('q')) {
      $query = $query->where('keterangan', 'LIKE', '%' . $request->q . '%');
    }

    if ($request->filled('tanggal_mulai')) {
      $query = $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
    }

    if ($request->filled('tanggal_selesai')) {
      $query = $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
    }

    $kas = $query->latest()->paginate(50);
    $saldoAkhir = Kas::SaldoAkhir();
    $totalPemasukan = $kas->where('jenis', 'masuk')->sum('jumlah');
    $totalPengeluaran = $kas->where('jenis', 'keluar')->sum('jumlah');

    if ($request->page == "laporan") {
      return view('kas.kas_laporan', compact('kas', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran'));
    }

    return view('kas.index', compact('kas', 'saldoAkhir', 'totalPemasukan', 'totalPengeluaran'));
  }

  public function create()
  {
    $kas = new Kas();
    $saldoAkhir = Kas::SaldoAkhir();
    $disable = [];
    return view('kas.create', compact('kas', 'saldoAkhir', 'disable'));
  }

  public function store(Request $request)
  {
    $requestData = $request->validate([
      'tanggal' => 'required|date',
      'keterangan' => 'required',
      'kategori' => 'nullable',
      'jenis' => 'required|in:masuk,keluar',
      'jumlah' => 'required ',
    ]);

    $tanggalTransaksi = Carbon::parse($requestData['tanggal']);
    $tahunBulanTransaksi = $tanggalTransaksi->format('Ym');
    $tahunBulanSekarang = Carbon::now()->format('Ym');

    if ($tahunBulanTransaksi != $tahunBulanSekarang) {
      flash('Data kas gagal ditambahkan, Transaksi hanya bisa dilakukan untuk bulan ini')->error();
      return back();
    }

    $requestData['jumlah'] = str_replace('.', '', $requestData['jumlah']);
    $kas = new Kas();
    $kas->fill($requestData);
    $kas->masjid_id = auth()->user()->masjid_id;
    $kas->created_by = auth()->user()->id;

    if ($requestData['jenis'] == 'masuk') {
      $kas->saldo = $kas->masjid->saldo_akhir + $kas->jumlah;
    } else {
      $kas->saldo = $kas->masjid->saldo_akhir - $kas->jumlah;
    }
    // $kas->saldo_akhir = $saldoAkhir;
    $kas->save();



    flash('Data kas berhasil disimpan.')->success();
    return back();
  }

  public function show(Kas $kas)
  {
    // return view('kas.show', compact('kas'));
  }

  public function edit($id)
  {
    $kas = Kas::findOrFail($id);
    $saldoAkhir = Kas::SaldoAkhir();
    $disable = ['disabled'];
    return view('kas.create', compact('kas', 'saldoAkhir', 'disable'));
  }

  public function update(Request $request, $id)
  {
    $requestData = $request->validate([
      'kategori' => 'nullable',
      'keterangan' => 'required',
      'jumlah' => 'required'
    ]);
    $jumlah = str_replace('.', '', $requestData['jumlah']);
    $kas = Kas::findOrFail($id);
    $requestData['jumlah'] = $jumlah;
    $kas->fill($requestData);
    $kas->save();

    flash('Data kas berhasil diperbarui');
    return redirect()->route('kas.index');
  }

  public function destroy($id)
  {
    $kas = Kas::findOrFail($id);
    $kas->delete();
    flash('Data kas berhasil disimpan');
    return redirect()->route('kas.index');
  }
}
