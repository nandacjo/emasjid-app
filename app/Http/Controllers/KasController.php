<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index()
    {
        $kas = Kas::latest()->paginate(50);
        return view('kas.index', compact('kas'));
    }

    public function create()
    {
        $kas = new Kas();
        $saldoAkhir = Kas::SaldoAkhir();
        return view('kas.create', compact('kas', 'saldoAkhir'));
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
        return view('kas.show', compact('kas'));
    }

    public function edit(Kas $kas)
    {
        return view('kas.edit', compact('kas'));
    }

    public function update(Request $request, Kas $kas)
    {
        $request->validate([
            'masjid_id' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
            'saldo_akhir' => 'required|integer',
            'created_by' => 'required',
        ]);

        $kas->update($request->all());

        return redirect()->route('kas.index')->with('success', 'Data kas berhasil diperbarui.');
    }

    public function destroy(Kas $kas)
    {
        $kas->delete();

        return redirect()->route('kas.index')->with('success', 'Data kas berhasil dihapus.');
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
