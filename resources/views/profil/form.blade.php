@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3 text-uppercase">{{ isset($profil->id) ? "$title" : "$title" }}
        {{ auth()->user()->masjid->nama }}</h1>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    {!! Form::model($profil, [
                        'route' => isset($profil->slug) ? ['profil.update', $profil->slug] : 'profil.store',
                        'method' => isset($profil->slug) ? 'PUT' : 'POST',
                    ]) !!}

                    <!-- List Kategori -->
                    <div class="form-group mb-3">
                        {!! Form::label('kategori', 'Kategori') !!}
                        {!! Form::select('kategori', $listKategori, null, [
                            'class' => 'form-control',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('kategori') }}</span>
                    </div>

                    <!-- Judul -->
                    <div class="form-group mb-3">
                        {!! Form::label('judul', 'Judul') !!}
                        {!! Form::text(
                            'judul',
                            $profil->judul,
                            array_merge([
                                'class' => 'form-control',
                            ]),
                        ) !!}
                        <span class="text-danger">@errorInput('judul')</span>
                    </div>

                    <!-- Konten -->
                    <div class="form-group mb-3">
                        {!! Form::label('konten', 'konten') !!}
                        {!! Form::textarea('konten', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Isi profil',
                            'id' => 'summernote',
                        ]) !!}
                        <span class="text-danger">@errorInput('konten')</span>
                    </div>

                    <!-- Button  -->
                    {!! Form::submit(isset($profil->id) ? 'Update' : 'Simpan', ['class' => 'btn btn-success mb-3']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
