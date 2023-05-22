@extends('layouts.app_adminkit')

@section('title', 'Form Masjid')

@section('content')
    <h1 class="h3 mb-3">Form Masjid</h1>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        Silahkan isi data masjid yang anda kelola
                    </h5>
                </div>
                <div class="card-body">
                    {!! Form::model($masjid, ['method' => 'POST', 'route' => 'masjid.store']) !!}

                    <!-- Nama Masjid -->
                    <div class="form-group mb-3">
                        <label for="nama">Nama Masjid</label>
                        {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{!! $errors->first('nama') !!}</span>
                    </div>
                    <!-- End Nama Masjid -->

                    <!-- Alamat Masjid -->
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat Masjid</label>
                        {!! Form::text('alamat', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{!! $errors->first('alamat') !!}</span>
                    </div>
                    <!-- End Alamat Masjid -->

                    <!-- Nomor Telp Pengurus Masjid -->
                    <div class="form-group mb-3">
                        <label for="telp">Nomor Telp / No Hp Pengurus Masjid</label>
                        {!! Form::text('telp', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{!! $errors->first('telp') !!}</span>
                    </div>
                    <!-- Nomor Telp Pengurus Masjid -->

                    <!-- Email Masjid -->
                    <div class="form-group mb-3">
                        <label for="email">Email Masjid</label>
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{!! $errors->first('email') !!}</span>
                    </div>
                    <!-- Email Masjid -->

                    {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
