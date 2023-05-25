@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">{{ isset($kas->id) ? 'Edit Data Kas' : 'Tambah Data Kas' }}</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    {{-- {!! Form::model($kas, ['route' => ['kas.update', $kas->id], 'method' => 'PUT']) !!} --}}

                    {!! Form::model($kas, [
                        'route' => isset($kas->id) ? ['kas.update', $kas->id] : 'kas.store',
                        'method' => isset($kas->id) ? 'PUT' : 'POST',
                    ]) !!}



                    <div class="form-group mb-3">
                        {!! Form::label('tanggal', 'Tanggal') !!}
                        {!! Form::date('tanggal', $kas->tanggal ?? now(), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('kategori', 'Kategori') !!}
                        {!! Form::text('kategori', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('kategori') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('keterangan', 'Keterangan') !!}
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3]) !!}
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('jenis', 'Jenis Transaksi') !!}
                        <div class="form-check">
                            {!! Form::radio('jenis', 'masuk', true, ['id' => 'jenis_masuk', 'class' => 'form-check-input']) !!}
                            {!! Form::label('jenis_masuk', 'Masuk', ['class' => 'form-check-label']) !!}
                        </div>
                        <div class="form-check">
                            {!! Form::radio('jenis', 'keluar', null, ['id' => 'jenis_keluar', 'class' => 'form-check-input']) !!}
                            {!! Form::label('jenis_keluar', 'Keluar', ['class' => 'form-check-label']) !!}
                        </div>
                        <span class="text-danger">{{ $errors->first('jenis') }}</span>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('jumlah', 'Jumlah') !!}
                        {!! Form::number('jumlah', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                    </div>


                    {!! Form::submit(isset($kas->id) ? 'Update' : 'Simpan', ['class' => 'btn btn-success mb-3']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection