@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3 text-uppercase">{{ isset($models->id) ? "$title" : "$title" }}
        {{ auth()->user()->masjid->nama }}</h1>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    {!! Form::model($models, [
                        'route' => isset($models->id) ? ['masjid-bank.update', $models->id] : 'masjid-bank.store',
                        'method' => isset($models->id) ? 'PUT' : 'POST',
                    ]) !!}

                    <!-- Judul -->
                    <div class="form-group mb-3">
                        {!! Form::label('nama_bank', 'Nama Bank') !!}
                        {!! Form::select('bank_id', $listBank, $bankSelect ?? null, [
                            'class' => 'form-control select2',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('nama_bank') }}</span>
                    </div>

                    <!-- Nama rekening -->
                    <div class="form-group mb-3">
                        {!! Form::label('nama_rekening', 'Nama Pemilik Rekening') !!}
                        {!! Form::text('nama_rekening', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nama_rekening') }}</span>
                    </div>

                    <!-- Nomor rekening -->
                    <div class="form-group mb-3">
                        {!! Form::label('nomor_rekening', 'Nomor Rekening') !!}
                        {!! Form::text('nomor_rekening', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nomor_rekening') }}</span>
                    </div>


                    <!-- Button  -->
                    {!! Form::submit(isset($models->id) ? 'Update' : 'Simpan', ['class' => 'btn btn-primary mb-3']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
