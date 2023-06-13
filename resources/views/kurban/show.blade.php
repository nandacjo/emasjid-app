@extends('layouts.app_adminkit')

@section('content')
    <div class="row">
        <div class="col text-center fw-bold text-uppercase">
            <h1 class="h1 fw-bold text-uppercase">{{ $title }}</h1>
            <hr>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <h3 class="fw-bold">Tahun Kurban: {{ $model->tahun_hijriah . '/' . $model->tahun_masehi }}</h3>
            <h6><i class="align-middle" data-feather="calendar"></i> Tanggal Akhir Pendaftaran:
                <b>{{ $model->tanggal_akhir_pendaftaran->translatedFormat('l, d-m-Y') }}</b>
            </h6>
            <h6 class="text-muted text-sm"><i class="align-middle" data-feather="user"></i> Created By:
                <b>{{ $model->createdBy->name }}, {{ $model->created_at->diffForHumans() }}</b>
            </h6>
            <p class="mt-2">
                {!! $model->konten !!}
            </p>
            <hr>
            <h4>Data Hewan Kurban</h4>
            @if ($model->hewankurban->count() == 0)
                <div class="text-center">
                    Belum ada data. <a href="{{ route('kurban-hewan.create', ['kurban_id' => $model->id]) }} ">Buat
                        Baru</a>
                </div>
            @else
            @endif

        </div>
    </div>
@endsection
