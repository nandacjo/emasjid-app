@extends('layouts.app_adminkit')

@section('content')
    <h1 class="h3 mb-3 text-uppercase">{{ isset($model->id) ? "$title" : "$title" }}
        {{ auth()->user()->masjid->nama }}</h1>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <div class="badge bg-danger mb-2">
                        Warning: Tanda * waji diisi
                    </div>

                    {!! Form::model($model, [
                        'route' => isset($model->id) ? ['kurban-hewan.update', $model->id] : 'kurban-hewan.store',
                        'method' => isset($model->id) ? 'PUT' : 'POST',
                    ]) !!}

                    <!-- Tahun Jenis Hewan -->
                    <div class="form-group mb-3">
                        <label for="hewan">Jenis Hewan <span class="text-danger">*</span></label>

                        {!! Form::select(
                            'hewan',
                            [
                                'sapi' => 'Sapi',
                                'kambing' => 'Kambing',
                                'domba' => 'Domba',
                                'kerbau' => 'Kerbau',
                                'unta' => 'Unta',
                            ],
                            null,
                            ['class' => 'form-control', 'placeholder' => '-- Pilih jenis hewan --'],
                        ) !!}
                        <span class="text-danger">{{ $errors->first('hewan') }}</span>
                    </div>

                    <!-- Kurban id hidden -->
                    {!! Form::hidden('kurban_id', $kurban->id, []) !!}


                    <!-- Kriteria -->
                    <div class="form-group mb-3">
                        {!! Form::label('kriteria', 'Kriteria (Misalnya: Kambing Super)') !!}
                        {!! Form::text('kriteria', $model->kriteria ?? 'Standar', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('kriteria') }}</span>
                    </div>

                    <!-- Iurang perorang -->
                    <div class="form-group mb-3">
                        <label for="iuran_perorang">Iuran Perorangan <span class="text-danger">*</span></label>
                        {!! Form::text('iuran_perorang', null, ['class' => 'form-control rupiah', 'placeholder' => 'Iuran perorang']) !!}
                        <span class="text-danger">{{ $errors->first('iuran_perorang') }}</span>
                    </div>


                    <!-- Harga -->
                    <div class="form-group mb-3">
                        {!! Form::label('harga', 'Harga') !!}
                        {!! Form::text('harga', null, ['class' => 'form-control rupiah', 'placeholder' => 'Harga hewan']) !!}
                        <span class="text-danger">{{ $errors->first('harga') }}</span>
                    </div>

                    <!-- Biaya Operasional -->
                    <div class="form-group mb-3">
                        {!! Form::label('biaya_operasional', 'Biaya Operasional') !!}
                        {!! Form::text('biaya_operasional', null, [
                            'class' => 'form-control rupiah',
                            'placeholder' => 'Biaya operasional',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('biaya_operasional') }}</span>
                    </div>

                    <!-- Button  -->
                    {!! Form::submit(isset($model->id) ? 'Update' : 'Simpan', ['class' => 'btn btn-sm btn-primary']) !!}
                    <a href="{{ route('kurban.show', $kurban->id) }}" class="btn btn-sm btn-secondary mx-2"><i
                            class="align-middle" data-feather="arrow-left-circle "></i> Kembali</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
