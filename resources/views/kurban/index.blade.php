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
                    <a href="{{ route('kurban.create') }}" class="d-block btn btn-primary">Tambah Data </a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="{{ config('app.table_style') }}">
                <thead>
                    <tr>
                        <th width="3%">ID</th>
                        <th>Tahun</th>
                        <th>Tanggal akhir daftar</th>
                        <th>Konten</th>
                        <th>Dibuat Oleh</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($model as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tahun_hijriah }}H / {{ $data->tahun_masehi }}M</td>
                            <td>{{ $data->tanggal_akhir_pendaftaran->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}</td>
                            <td>
                                <div>{{ strip_tags($data->konten) }}</div>
                            </td>
                            <td>{{ $data->createdBy->name }}</td>

                            <td width='10%' class="text-center">
                                <div class="">
                                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a href="{{ route('kurban.show', $data->id) }}"
                                                class="dropdown-item">Detail</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('kurban.edit', $data->id) }}" class="dropdown-item">Edit</a>
                                        </li>
                                        <li>
                                            <!-- Tombol Delete -->
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['kurban.destroy', $data->id],
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
            {{ $model->links() }}
        </div>
    </div>
@endsection
