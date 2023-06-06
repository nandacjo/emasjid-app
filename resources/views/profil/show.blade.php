@extends('layouts.app_adminkit')

@section('content')
    <div class="row">
        <div class="col text-center fw-bold text-uppercase">
            <h1 class="h1 fw-bold text-uppercase">{{ $title }} {{ auth()->user()->masjid->nama }}</h1>
            <hr>
        </div>
    </div>
    {{-- <div class="row mb-4 mt-3">
        <div class="col-md-12">
            <h2 class="h3">Profil </h2>
        </div>
    </div> --}}

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-light">
                <tr>
                    <th width="15%">Judul</th>
                    <td>: {{ $profil->judul }}</td>
                </tr>
                <tr>
                    <th>Konten</th>
                    <td>: {!! $profil->konten !!}</td>
                </tr>
                <tr>
                    <th>Tanggal Posting</th>
                    <td>: {!! $profil->created_at->translatedFormat('l, d F y') !!}</td>
                </tr>

                <tr>
                    <th>Created By</th>
                    <td>: {!! $profil->createdBy->name !!}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
