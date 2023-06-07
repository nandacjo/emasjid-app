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
            <table class="table table-light table-bordered">
                <tr>
                    <th width="15%">Judul</th>
                    <td>: {{ $model->judul }}</td>
                </tr>
                <tr>
                    <th>Konten</th>
                    <td>: {!! $model->konten !!}</td>
                </tr>
                <tr>
                    <th>Tanggal Posting</th>
                    <td>: {!! $model->created_at->translatedFormat('l, d F y') !!}</td>
                </tr>

                <tr>
                    <th>Created By</th>
                    <td>: {!! $model->createdBy->name !!}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
