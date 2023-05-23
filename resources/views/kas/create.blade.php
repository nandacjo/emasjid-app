@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3">{{ isset($kas) ? 'Edit Data Kas' : 'Tambah Data Kas' }}</h1>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    @if (isset($kas))
                        {!! Form::model($kas, ['route' => ['kas.update', $kas->id], 'method' => 'PUT']) !!}
                    @else
                        {!! Form::open(['route' => 'kas.store', 'method' => 'POST']) !!}
                    @endif


                    <div class="form-group mt-3">
                        {!! Form::label('tanggal', 'Tanggal') !!}
                        {!! Form::date('tanggal', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group mt-3">
                        {!! Form::label('kategori', 'Kategori') !!}
                        {!! Form::text('kategori', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group mt-3">
                        {!! Form::label('keterangan', 'Keterangan') !!}
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group mt-3">
                        {!! Form::label('jenis', 'Jenis') !!}
                        {!! Form::select('jenis', ['masuk' => 'Masuk', 'keluar' => 'Keluar'], null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group mt-3">
                        {!! Form::label('jumlah', 'Jumlah') !!}
                        {!! Form::number('jumlah', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group mt-3">
                        {!! Form::label('saldo_akhir', 'Saldo Akhir') !!}
                        {!! Form::number('saldo_akhir', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group mt-3">
                        {!! Form::label('created_by', 'Created By') !!}
                        {!! Form::text('created_by', null, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit(isset($kas) ? 'Update' : 'Simpan', ['class' => 'btn btn-success mt-3']) !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
