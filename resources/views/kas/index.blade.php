@extends('layouts.app_adminkit')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="h3">Data Kas</h2>
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
                        <th>Masjid ID</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Saldo Akhir</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kas as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->masjid_id }}</td>
                            <td>{{ $data->tanggal }}</td>
                            <td>{{ $data->kategori }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>{{ $data->jenis }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>{{ $data->saldo_akhir }}</td>
                            <td>{{ $data->created_by }}</td>
                            <td>
                                <a href="{{ route('kas.show', $data->id) }}" class="btn btn-primary">Detail</a>
                                <a href="{{ route('kas.edit', $data->id) }}" class="btn btn-secondary">Edit</a>
                                <form action="{{ route('kas.destroy', $data->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
