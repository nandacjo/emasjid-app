@extends('layouts.app_laporan')

@section('content')
  <div class="row mt-3">
    <div class="col text-center fw-bold text-uppercase">
      <h1 class="h1 fw-bold text-uppercase">{{ $title }} {{ auth()->user()->masjid->nama }} <h3 class="fw-bold">Tahun
          :
          {{ $model->tahun_hijriah . 'H' . '/' . $model->tahun_masehi . 'M' }}</h3>
      </h1>
      <hr>
    </div>
  </div>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="text-end">
    <h3 class="fw-bold">Tahun Kurban: {{ $model->tahun_hijriah . '/' . $model->tahun_masehi }}</h3>
  </div>
  <b>{{ $model->tanggal_akhir_pendaftaran->translatedFormat('l, d-m-Y') }}</b>
  </h6>
  <p class="text-muted text-sm"> Created By:
    <b>{{ $model->createdBy->name }}, {{ $model->created_at->diffForHumans() }}</b>
  </p>
  <p class="mt-1">
    {!! $model->konten !!}
  </p>

  <hr>

  <!-- Daftar hewan kurban -->
  <h4>Data Hewan Kurban</h4>



  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="1%">NO</th>
          <th>HEWAN</th>
          <th>IURAN</th>
          <th>HARGA</th>
          <th>BIAYA OPS</th>
          <th>CRETED BY</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($model->kurbanHewan as $data)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->hewan }} ({{ $data->kriteria }})</td>
            <td>{{ formatRupiah($data->iuran_perorang, true) }}</td>
            <td>{{ formatRupiah($data->harga, true) }}</td>
            <td>{{ formatRupiah($data->biaya_operasional, true) }}</td>
            <td>{{ $data->createdBy->name }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- Daftar hewan kurban end -->

  <hr>

  <!-- Daftar peserta -->
  <h4>Data Peserta Kurban</h4>

  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="1%">NO</th>
          <th>NAMA</th>
          <th>NO. HP</th>
          <th>ALAMAT</th>
          <th>JENIS HEWAN</th>
          <th class="text-center">STATUS PEMBAYARAN</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($model->kurbanPeserta as $data)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
              <div>{{ $data->peserta->nama }} - ({{ $data->peserta->nama }})</div>
            </td>
            <td>{{ $data->peserta->nohp }}</td>
            <td>{{ $data->peserta->alamat }}</td>
            <td>
              {{ Str::ucfirst($data->kurbanHewan->hewan) }} -
              {{ $data->kurbanHewan->kriteria }} -
              {{ $data->kurbanHewan->iuran_perorang }}
            </td>
            <td class="text-center">
              {{ $data->getStatusTeks() }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <hr>

    <h3 class="h4 fw-bold">Total Peserta : {{ $model->kurbanPeserta->count() }}</h3>
    <h3 class="h4 fw-bold">Total Sudah Bayar : {{ $model->kurbanPeserta->where('status_bayar', 'lunas')->count() }}</h3>
    <h3 class="h4 fw-bold">Total Iuran Peserta : {{ formatRupiah($model->kurbanPeserta->sum('total_bayar'), true) }}</h3>
    <h3 class="h4 fw-bold">Total Peserta Sudah Bayar :
      {{ formatRupiah($model->kurbanPeserta->where('status_bayar', 'lunas')->sum('total_bayar'), true) }}
    </h3>
  </div>
  <!-- Daftar peserta ende-->
@endsection
