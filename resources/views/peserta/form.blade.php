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

                    <!-- Nama Peserta Kurban -->
                    <div class="form-group mb-3">
                        {!! Form::label('nama', 'Nama Lengkap Peserta') !!}
                        {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Name lengkap peserta']) !!}
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
                        {!! Form::text('nohp', null, ['class' => 'form-control', 'placeholder' => 'No. HP']) !!}
                        <span class="text-danger">{{ $errors->first('nohp') }}</span>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group mb-3">
                        {!! Form::label('alamat', 'Alamat') !!}
                        {!! Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Alamat']) !!}
                        <span class="text-danger">{{ $errors->first('alamat') }}</span>
                    </div>



                    <!-- Button  -->
                    {!! Form::submit(isset($model->id) ? 'Update' : 'Simpan', ['class' => 'btn btn-sm btn-primary']) !!}
                    <a href="{{ route('kurban.show', $kurban->id) }}" class="btn btn-sm btn-secondary mx-2"><i
                            class="align-middle" data-feather="arrow-left-circle "></i> Kembali</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="table-responsive">
                <table class="{{ config('app.table_style') }}">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Nama Tampilan</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
