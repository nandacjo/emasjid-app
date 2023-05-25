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
        $kas['masjid'] = $kas->masjid->name;
        return view('kas.create', compact('kas'));
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'kategori' => 'nullable',
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
        ]);

        $kasAkhir = Kas::where('masjid_id', auth()->user()->masjid_id)
            ->orderBy('tanggal', 'desc')->first();

        $saldoAkhir = 0;
        if (isset($kasAkhir->saldo_akhir)) {
            // saldo terkahir di tambah dengna jumlah transaksi masuk / keluar
            if ($requestData['jenis'] == 'masuk') {
                $saldoAkhir = $kasAkhir->saldo_akhir + $requestData['jumlah'];
            } else {
                if ($kasAkhir) {
                    $saldoAkhir = $kasAkhir->saldo_akhir - $requestData['jumlah'];
                }
            }
        } else {
            // saldo pertama
            if ($requestData['jenis'] == 'keluar') {
                flash('Maaf saldo belum ada isinya, silahkan melakukan isi pulang')->error();
                return back();
            }
            $saldoAkhir = $requestData['jumlah'];
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
