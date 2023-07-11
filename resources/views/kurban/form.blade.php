@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3 text-uppercase">{{ isset($model->id) ? "$title" : "$title" }}
        {{ auth()->user()->masjid->nama }}</h1>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    {!! Form::model($model, [
                        'route' => isset($model->id) ? ['kurban.update', $model->id] : 'kurban.store',
                        'method' => isset($model->id) ? 'PUT' : 'POST',
                    ]) !!}

                    <!-- Tahun hijriah -->
                    <div class="form-group mb-3">
                        {!! Form::label('tahun_hijriah', 'Tahun Hijriah') !!}
                        {!! Form::selectRange('tahun_hijriah', 1455, 1460, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">@errorInput('tahun_hijriah')</span>
                    </div>

                    <!-- Tahun masehi -->
                    <div class="form-group mb-3">
                        {!! Form::label('tahun_masehi', 'Tahun Hijriah') !!}
                        {!! Form::selectRange('tahun_masehi', now()->year, date('Y'), null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tahun_masehi') }}</span>
                    </div>

                    <!-- Tahun akhir pendaftaran -->
                    <div class="form-group mb-3">
                        {!! Form::label('tanggal_akhir_pendaftaran', 'Tanggal Akhir pendaftaran') !!}
                        {!! Form::date('tanggal_akhir_pendaftaran', now(), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_akhir_pendaftaran') }}</span>
                    </div>

                    <!-- Konten -->
                    <div class="form-group mb-3">
                        {!! Form::label('konten', 'Informasi Kurban') !!}
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
