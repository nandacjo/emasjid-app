@extends('layouts.app_adminkit')

@section('content')
  <h1 class="h3 mb-3 text-uppercase">{{ isset($model->id) ? "$title" : "$title" }}
    {{ auth()->user()->masjid->nama }}</h1>
  <div class="row">
    <div class="col-8">
      <div class="card">
        <div class="card-body">

          {!! Form::model($model, [
              'route' => isset($model->id) ? ['infaq.update', $model->id] : 'infaq.store',
              'method' => isset($model->id) ? 'PUT' : 'POST',
          ]) !!}

          <!-- Sumber -->
          <div class="form-group mb-3">
            {!! Form::label('sumber', 'Sumber Dana Infaq') !!}
            {!! Form::select('sumber', $listSumberDana, null, [
                'class' => 'form-control',
            ]) !!}
            <span class="text-danger">{{ $errors->first('sumber') }}</span>
          </div>

          <!-- Jenis Infaq -->
          <div class="form-group mb-3">
            {!! Form::label('jenis', 'Jenis Infaq') !!}
            <div class="form-check mb-2">
              {!! Form::radio('jenis', 'uang', true, ['id' => 'uang', 'class' => 'form-check-input']) !!}
              {!! Form::label('uang', 'Uang Tunai', ['class' => 'form-check-label']) !!}
            </div>
            <div class="form-check">
              {!! Form::radio('jenis', 'barang', null, ['id' => 'barang', 'class' => 'form-check-input']) !!}
              {!! Form::label('barang', 'Barang', ['class' => 'form-check-label']) !!}
            </div>
            <span class="text-danger">{{ $errors->first('jenis') }}</span>
          </div>

          <!-- Jumlah -->
          <div class="form-group mb-3">
            {!! Form::label('jumlah', 'Jumlah', ['class' => 'form-label']) !!}
            {!! Form::text('jumlah', null, ['class' => 'form-control rupiah']) !!}
            <span class="text-danger">{{ $errors->first('jumlak') }}</span>
          </div>

          <!-- Atas Nama -->
          <div class="form-group mb-3">
            {!! Form::label('atas_nama', 'Keterangan - boleh dikosongkan') !!}
            {!! Form::textarea('atas_nama', null, [
                'class' => 'form-control',
                'placeholder' => 'Keterangan',
                'rows' => 3,
            ]) !!}
            <span class="text-danger">{{ $errors->first('atas_nama') }}</span>
          </div>

          <!-- Satuan -->
          <div class="form-group mb-3">
            {!! Form::label('satuan', 'Satuan Jumlah - Misalnya, kg, rupiah, atau sak untuk semen', [
                'class' => 'form-label',
            ]) !!}
            {!! Form::text('satuan', $model->satuan ?? null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('satuan') }}</span>
          </div>

          <!-- Button  -->
          {!! Form::submit(isset($model->id) ? 'Update' : 'Simpan', ['class' => 'btn btn-primary']) !!}
          <a href="/infaq" class="btn btn-secondary">Kembali</a>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
