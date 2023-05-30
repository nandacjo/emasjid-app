<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index()
    {
        $kas = Kas::UserMasjid()->latest()->paginate(50);
        $saldoAkhir = Kas::SaldoAkhir();

        return view('kas.index', compact('kas', 'saldoAkhir'));
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

        /**
         * | Validasi tanggal transaksi
         * | Jika tanggal transaksi atau bulan tidak sama dengan
         * | Tanggal transaksi
         */
        $tanggalTransaksi = Carbon::parse($requestData['tanggal']);
        $tahunBulanTransaksi = $tanggalTransaksi->format('Ym');
        $tahunBulanSekarang = Carbon::now()->format('Ym');

        /**
         * | Melakukan pengecekan tanggal transaski
         */
        if($tahunBulanTransaksi != $tahunBulanSekarang){
            flash('Data kas gagal ditambahkan, Transaksi hanya bisa dilakukan untuk bulan ini')->error();
            return back();
        }

        /**
         * | Menghilangkan titik di request jumlah
         * | Karena dia input menggunakan library jquery musk
         * | Jadi nilainya pake titik
         */
        $requestData['jumlah'] = str_replace('.', '', $requestData['jumlah']);

        // $kasAkhir = Kas::where('masjid_id', auth()->user()->masjid_id)
        //     ->orderBy('created_at', 'desc')->first();

        // refactor code dengan membuat function scope di modelnya

        /**
         * | Function scope saldo akhir,terletak di model Kas
         */
        $saldoAkhir = Kas::SaldoAkhir();

        /**
         * | Cek jenis transaski yang masuk, masuk atau keluar
         */
        if ($requestData['jenis'] == 'masuk') {
            $saldoAkhir += $requestData['jumlah'];
        } else {
            $saldoAkhir -= $requestData['jumlah'];
        }

        /**
         * | Cek apakah saldo akhir apakah lebih kecil atau sama dengan -1
         * | Jika true kembalikan error
         */
        if ($saldoAkhir <= -1) {
            flash('Data kas gagal ditambahkan. Saldo akhir di kurang transaksi tidak boleh kurang dari nol 0')->error();
            return back();
        }

        // menyimpan data kas
        $kas = new Kas();
        $kas->fill($requestData);
        $kas->masjid_id = auth()->user()->masjid_id;
        $kas->created_by = auth()->user()->id;
        // $kas->saldo_akhir = $saldoAkhir;
        $kas->save();

        // update saldo akhir di table mesjid berdasarkan user pengelola masjid
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);

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
        // Saldo akhir
        $saldoAkhir = Kas::SaldoAkhir();

        // Ambil data kas berdasarkan id user
        $kas = Kas::findOrFail($id);

        // jika jenis masuk, maka saldo akhir di kurang kas jumlah yang di edit
        if($kas->jenis == 'masuk'){
            $saldoAkhir -= $kas->jumlah;
            $saldoAkhir += $jumlah;

        }

        // jika jenis keluar, maka saldo akhir di tambah kas jumlah yang di edit
        if($kas->jenis == 'keluar'){
            $saldoAkhir += $kas->jumlah;
            // Saldo akhir akan di update di table masjid
            $saldoAkhir -= $jumlah;
        }


        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);

        // Ini akan di save ke tabel kas
        $requestData['jumlah'] = $jumlah;
        $kas->fill($requestData);
        $kas->save();

        flash('Data kas berhasil diperbarui');
        return redirect()->route('kas.index');
    }

    public function destroy($id)
    {
        $kas = Kas::findOrFail($id);
        $saldoAkhir = Kas::SaldoAkhir();
        
        // jika membatalkan pemasukkan, maka kas berkurang
        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
        }

        if ($kas->jenis == 'keluar') {
            $saldoAkhir += $kas->jumlah;
        }

        $kas->delete();
        auth()->user()->masjid->update(['saldo_akhir' => $saldoAkhir]);

        flash('Data kas berhasil disimpan');
        return redirect()->route('kas.index');
    }

    public function destroyDua($id)
    {
        $kas = Kas::findOrFail($id);
        $kas->keterangan = 'Data di hapus oleh' . auth()->user()->name;
        $kas->save();

        $kasBaru = $kas->replicate();
        $kasBaru->keterangan = 'Perbaikan data id ke' . $kas->id;

        $saldoAkhir = Kas::SaldoAkhir();
        // jika membatalkan pemasukkan, maka kas berkurang
        if ($kas->jenis == 'masuk') {
            $saldoAkhir -= $kas->jumlah;
        }

        if ($kas->jenis == 'keluar') {
            $saldoAkhir += $kas->jumlah;
        }

        $kasBaru->saldo_akhir = $saldoAkhir;
        $kasBaru->save();

        flash('Data kas berhasil disimpan');
        return redirect()->route('kas.index');
    }

    public function destroyCaraSatu($id)
    {
        $kas = Kas::findOrFail($id);
        $kas->keterangan = 'Data di hapus oleh' . auth()->user()->name;
        $kas->save();

        $saldoAkhir = Kas::SaldoAkhir();
        $kasBaru = new Kas();

        $kasBaru->tanggal = $kas->tanggal;
        $kasBaru->kategori = $kas->kategori;
        $kasBaru->keterangan = 'Perbaikan Data';
        $kasBaru->jenis = $kas->jenis;
        $kasBaru->jumlah = $kas->jumlah;
        $kasBaru->masjid_id = $kas->masjid_id;
        $kasBaru->created_by = $kas->created_by;
        $kasBaru->saldo_akhir = $saldoAkhir - $kas->jumlah;
        $kasBaru->save();

        flash('Data kas berhasil diperbaiki');
        return redirect()->route('kas.index');
    }

    public function hitungSaldoAkhir()
    {
        $kas = Kas::orderBy('tanggal')->get();

        $saldo = 0;
        foreach ($kas as $data) {
            if ($data->jenis == 'masuk') {
                $saldo += $data->jumlah;
            } else {
                $saldo -= $data->jumlah;
            }

            // $data->saldo_akhir = $saldo;
            $data->save();
        }

        return redirect()->route('kas.index')->with('success', 'Saldo akhir berhasil dihitung.');
    }
}