@extends('layouts.app_adminkit')

@section('content')
<div class="row">
  <div class="col text-center fw-bold text-uppercase">
    <h1 class="h1 fw-bold"> {{ auth()->user()->masjid->nama }}</h1>
    <hr>
  </div>
</div>
<div class="row mb-4 mt-3">
  <div class="col-md-6">
    <h2 class="h3">Data Kas {{ auth()->user()->masjid->nama }}</h2>
  </div>
  <div class="col-md-6 text-end">
    <a href="{{ route('kas.create') }}" class="btn btn-primary">Tambah Data Kas</a>
    <a href="#" class="btn btn-secondary">Hitung Saldo Akhir</a>
  </div>
</div>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tanggal</th>
          <th>Kategori</th>
          <th>Keterangan</th>
          <th>Pemasukkan</th>
          <th>Pengeluaran</th>
          <th>Saldo Akhir</th>
          <th>Diinput Oleh</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($kas as $data)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $data->tanggal->translatedFormat('D, d-m-Y') }}</td>
          <td>{{ $data->kategori ?? 'Umum' }}</td>
          <td>{{ $data->keterangan }}</td>
          <td>
            <span class="badge bg-success">
              {{ $data->jenis == 'masuk' ? formatRupiah($data->jumlah) : '-' }}
            </span>
            {{-- <span class="badge {{ $data->jenis == 'keluar' ? 'bg-danger' : 'bg-success' }}">{{ Str::ucfirst($data->jenis) }}</span> --}}
          </td>
          <td>
            <span class="badge bg-danger">{{ $data->jenis == 'keluar' ? formatRupiah($data->jumlah) : '-' }}</span>
          </td>
          <td>{{ formatRupiah($data->saldo_akhir, true) }}</td>
          <td>{{ $data->createdBy->name }}</td>
          <td class="d-flex gap-2">
            <a href="{{ route('kas.show', $data->id) }}" class="btn btn-primary btn-sm">Detail</a>
            <a href="{{ route('kas.edit', $data->id) }}" class="btn btn-secondary btn-sm">Edit</a>
            <form action="{{ route('kas.destroy', $data->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $kas->links() }}
  </div>
</div>
@endsection
