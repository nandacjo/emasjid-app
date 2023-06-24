@extends('layouts.app_laporan')

@section('content')
  <div class="row mt-3">
    <div class="col text-center">
      <h1 class="h3 mb-0 fw-bold text-uppercase">Laporan Kas {{ auth()->user()->masjid->nama }}</h1>
      <p class="fs-5">Alamat: {{ auth()->user()->masjid->alamat }}</p>
      <hr>
    </div>
  </div>

  <div class="row my-4">
    <div class="col">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Diinput Oleh</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th class="text-end">Pemasukan</th>
            <th class="text-end">Pengeluaran</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($kas as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->createdBy->name }}</td>
              <td>{{ $data->tanggal->translatedFormat('l, d-m-Y') }}</td>
              <td>{{ $data->keterangan }}</td>
              <td class="text-end">
                {{ $data->jenis == 'masuk' ? formatRupiah($data->jumlah, true) : '-' }}
              </td>
              <td class="text-end">
                {{ $data->jenis == 'keluar' ? formatRupiah($data->jumlah, true) : '-' }}
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="text-center fw-bold">Total</td>
            <td class="text-end">{{ formatRupiah($totalPemasukan, true) }}</td>
            <td class="text-end">{{ formatRupiah($totalPengeluaran, true) }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col d-flex justify-content-end" style="margin-top: 100px">
      <div>
        <p class="mb-5">Singkil, {{ now()->translatedFormat('d M Y') }}</p>
        <p class="mt-5 fw-bold" style="margin-top: 80px !important;">({{ Str::ucfirst(auth()->user()->name) }})</p>
      </div>
    </div>
  </div>
@endsection
