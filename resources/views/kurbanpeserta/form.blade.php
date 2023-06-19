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
                        'route' => isset($model->id) ? ['kurban-peserta.update', $model->id] : 'kurban-peserta.store',
                        'method' => isset($model->id) ? 'PUT' : 'POST',
                    ]) !!}

                    <!-- Nama Peserta Kurban -->
                    <div class="form-group mb-3">
                        {!! Form::label('nama', 'Nama Lengkap Peserta') !!}
                        {!! Form::text('nama', null, ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>

                    <!-- Tahun tampilan di halaman web -->
                    <div class="form-group mb-3">
                        {!! Form::label('nama_tampilan', 'Nama tampilan di halaman web') !!}
                        {!! Form::text('nama_tampilan', $model->nama_tampilan ?? 'Hamba Allah', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nama_tampilan') }}</span>
                    </div>

                    <!-- Nomor HP -->
                    <div class="form-group mb-3">
                        {!! Form::label('nohp', 'No. HP') !!}
                        {!! Form::text('nohp', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nohp') }}</span>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group mb-3">
                        {!! Form::label('alamat', 'Alamat') !!}
                        {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3]) !!}
                        <span class="text-danger">{{ $errors->first('alamat') }}</span>
                    </div>

                    <!-- Data hewan kurban -->
                    <div class="form-group mb-3">
                        {!! Form::label('kurban_hewan_id', 'Pilih Hewan Kurban') !!}
                        {!! Form::select('kurban_hewan_id', $listHewanKurban, null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_akhir_pendaftaran') }}</span>
                    </div>

                    {!! Form::hidden('kurban_id', $kurban->id, []) !!}

                    <!-- Status pembayaran -->
                    <div class="form-group mb-3">
                        <div class="form-check">
                            {!! Form::checkbox('status_bayar', 1, $model->status_bayar ?? false, [
                                'class' => 'form-check-input',
                                'id' => 'my-input',
                            ]) !!}
                            <label for="my-input" class="form-check-label">Sudah Melakukan Pembayaran</label>
                        </div>
                        <span class="text-danger">{{ $errors->first('status_bayar') }}</span>
                    </div>

                    <!-- Total Bayar -->
                    <div class="form-group mb-3">
                        {!! Form::label('total_bayar', 'Total Bayar') !!}
                        {!! Form::text('total_bayar', null, ['class' => 'form-control rupiah']) !!}
                        <span class="text-danger">{{ $errors->first('total_bayar') }}</span>
                    </div>

                    <!-- Tanggal Bayar -->
                    <div class="form-group mb-3">
                        {!! Form::label('tanggal_bayar', 'Tanggal Bayar') !!}
                        {!! Form::text('tanggal_bayar', $model->tanggal_bayar ?? now(), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
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
