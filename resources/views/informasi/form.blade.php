@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3 text-uppercase">{{ isset($model->id) ? "$title" : "$title" }}
        {{ auth()->user()->masjid->nama }}</h1>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    {!! Form::model($model, [
                        'route' => isset($model->slug) ? ['informasi.update', $model->slug] : 'informasi.store',
                        'method' => isset($model->id) ? 'PUT' : 'POST',
                    ]) !!}

                    <!-- List Kategori -->
                    <div class="form-group mb-3">
                        {!! Form::label('kategori', 'Kategori') !!}
                        <a class="badge bg-primary my-2 text-decoration-none ms-2"
                            href="{{ route('kategori.create') }}">Add</a>
                        {!! Form::select('kategori_id', $listKategori, null, [
                            'class' => 'form-control',
                            'placeholder' => 'Pilih kategori informasi',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('kategori') }}</span>
                    </div>

                    <!-- Judul -->
                    <div class="form-group mb-3">
                        {!! Form::label('judul', 'Judul') !!}
                        {!! Form::text(
                            'judul',
                            $model->judul,
                            array_merge([
                                'class' => 'form-control',
                            ]),
                        ) !!}
                        <span class="text-danger">{{ $errors->first('judul') }}</span>
                    </div>

                    <!-- Konten -->
                    <div class="form-group mb-3">
                        {!! Form::label('konten', 'Konten / Isi Profil') !!}
                        {!! Form::textarea('konten', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Isi model',
                            'id' => 'summernote',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('konten') }}</span>
                    </div>

                    <!-- Button  -->
                    {!! Form::submit(isset($model->id) ? 'Update' : 'Simpan', ['class' => 'btn btn-success mb-3']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
