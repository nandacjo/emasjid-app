<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index()
    {
        $kas = Kas::UserMasjid()->latest()->paginate(50);
        return view('kas.index', compact('kas'));
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

        $requestData['jumlah'] = str_replace('.', '', $requestData['jumlah']);

        // $kasAkhir = Kas::where('masjid_id', auth()->user()->masjid_id)
        //     ->orderBy('created_at', 'desc')->first();

        // refactor code dengan membuat function scope di modelnya
        $saldoAkhir = Kas::SaldoAkhir();
        if ($requestData['jenis'] == 'masuk') {
            $saldoAkhir += $requestData['jumlah'];
        } else {
            $saldoAkhir -= $requestData['jumlah'];
        }

        if ($saldoAkhir <= -1) {
            flash('Data kas gagal ditambahkan. Saldo akhir di kurang transaksi tidak boleh kurang dari nol 0')->error();
            return back();
        }

        $kas = new Kas();
        $kas->fill($requestData);
        $kas->masjid_id = auth()->user()->masjid_id;
        $kas->created_by = auth()->user()->id;
        $kas->saldo_akhir = $saldoAkhir;
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
        ]);
        $kas = Kas::findOrFail($id);
        $kas->fill($requestData);
        $kas->save();

        flash('Data kas berhasil diperbarui');
        return redirect()->route('kas.index');
    }

    public function destroy($id)
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

            $data->saldo_akhir = $saldo;
            $data->save();
        }

        return redirect()->route('kas.index')->with('success', 'Saldo akhir berhasil dihitung.');
    }
}
