@extends('layouts.app_adminkit')

@section('title', 'Form Masjid')

@section('content')
    <h1 class="h3 mb-3">Ubah Data User</h1>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    {!! Form::model(auth()->user(), ['method' => 'PUT', 'route' => ['user-profil.update', 0]]) !!}

                    <!-- Nama -->
                    <div class="form-group mb-3">
                        <label for="name">name</label>
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{!! $errors->first('name') !!}</span>
                    </div>
                    <!-- End Nama -->

                    <!-- Alamat email -->
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{!! $errors->first('email') !!}</span>
                    </div>
                    <!-- End Alamat email -->

                    <!-- Password -->
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                        <span class="text-danger">{!! $errors->first('password') !!}</span>
                    </div>
                    <!-- End Password -->

                    {!! Form::submit('Simpan Perubahan', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
