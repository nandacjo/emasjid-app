@extends('layouts.app_adminkit')

@section('content')
    <div class="row">
        <div class="col text-center fw-bold text-uppercase">
            <h1 class="h1 fw-bold"> Kategori Informasi</h1>
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
                    <a href="{{ route('kategori.create') }}" class="d-block btn btn-primary">Tambah Kategori</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="{{ config('app.table_style') }}">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Nama Masjid</th>
                        <th>Keterangan</th>
                        <th>Dibuat Oleh</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->masjid->nama }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>{{ $data->createdBy->name }}</td>

                            <td width='10%' class="text-center">
                                <div class="">
                                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a href="{{ route('kategori.edit', $data->id) }}" class="dropdown-item">Edit</a>
                                        </li>
                                        <li>
                                            <!-- Tombol Delete -->
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['kategori.destroy', $data->id],
                                                'style' => 'display.inline',
                                            ]) !!}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                            {!! Form::close() !!}
                                            <!-- Tombol Delete -->
                                        </li>
                                    </ul>
                                </div>




                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $models->links() }}
        </div>
    </div>
@endsection
