@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3 text-uppercase">{{ isset($model->id) ? "$title" : "$title" }}
        {{ auth()->user()->masjid->nama }}</h1>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    {!! Form::model($model, [
                        'route' => isset($model->id) ? ['kategori.update', $model->id] : 'kategori.store',
                        'method' => isset($model->id) ? 'PUT' : 'POST',
                    ]) !!}


                    <!-- Nama kategori -->
                    <div class="form-group mb-3">
                        {!! Form::label('nama', 'Nama Kategori') !!}
                        {!! Form::text(
                            'nama',
                            $model->nama,
                            array_merge([
                                'class' => 'form-control',
                                'placeholder' => 'Nama kategori',
                            ]),
                        ) !!}
                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>

                    <!-- Keterangan -->
                    <div class="form-group mb-3">
                        {!! Form::label('keterangan', 'Keterangan') !!}
                        {!! Form::textarea('keterangan', null, [
                            'class' => 'form-control',
                            'placeholder' => 'Keterangan',
                            'rows' => '2',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                    </div>

                    <!-- Button  -->
                    {!! Form::submit(isset($model->id) ? 'Update' : 'Simpan', ['class' => 'btn btn-success mb-3']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
