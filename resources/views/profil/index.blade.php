@extends('layouts.app_adminkit')

@section('content')
    <div class="row">
        <div class="col text-center fw-bold text-uppercase">
            <h1 class="h1 fw-bold text-uppercase"> {{ $title }} {{ auth()->user()->masjid->nama }}</h1>
            <hr>
        </div>
    </div>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-auto ">
                    <label></label>
                    <a href="{{ route('profil.create') }}" class="d-block btn btn-primary">Tambah Data Kas</a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Konten</th>
                        <th>Dibuat Oleh</th>
                        <th>Pemasukkan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->kategori ?? 'Umum' }}</td>
                            <td>{{ strip_tags($data->konten) }}</td>
                            <td>{{ $data->createdBy->name }}</td>

                            <td class="d-flex gap-2">
                                <a href="{{ route('profil.show', $data->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                <a href="{{ route('profil.edit', $data->id) }}" class="btn btn-secondary btn-sm">Edit</a>

                                <!-- Tombol Delete -->
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['profil.destroy', $data->id],
                                    'style' => 'display.inline',
                                ]) !!}
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                {!! Form::close() !!}
                                <!-- Tombol Delete -->

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $models->links() }}
        </div>
    </div>
@endsection
