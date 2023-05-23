<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use Illuminate\Http\Request;

class KasController extends Controller
{
    public function index()
    {
        $kas = Kas::all();
        return view('kas.index', compact('kas'));
    }

    public function create()
    {
        return view('kas.create');
    }

    public function store(Request $request)
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

        Kas::create($request->all());

        return redirect()->route('kas.index')->with('success', 'Data kas berhasil disimpan.');
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
