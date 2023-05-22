@extends('layouts.app_adminkit')

@section('title', 'Beranda')

@section('content')
    <h1 class="h3 mb-3">Beranda E-Masjid</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Selamat Datang {{ auth()->user()->name }}</h5>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
@endsection
