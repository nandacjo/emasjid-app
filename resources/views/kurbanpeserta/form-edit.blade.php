@extends('layouts.app_adminkit')
@section('content')
  <h1 class="h3 mb-3 text-uppercase">{{ isset($model->id) ? "$title" : "$title" }}
    {{ auth()->user()->masjid->nama }}</h1>
  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <h4><span class="fw-bold">Status Pembayaran :</span> {{ $model->getStatusTeks() }}</h4>

          <div class="alert alert-info" role="alert">
            <strong>Warning: </strong> Tanda * Wajib Diisi
          </div>

          {!! Form::model($model, [
              'route' => ['kurban-peserta.update', $model->id],
              'method' => 'PUT',
          ]) !!}

          <!-- Data hewan kurban -->
          <div class="form-group mb-3">
            {!! Form::label('kurban_hewan_id', 'Pilih Hewan Kurban') !!}
            {!! Form::select('kurban_hewan_id', $listHewanKurban, null, ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('tanggal_akhir_pendaftaran') }}</span>
          </div>

          {!! Form::hidden('kurban_id', $kurban->id, []) !!}

          <!-- Total Bayar -->
          <div class="form-group mb-3">
            {!! Form::label('total_bayar', 'Total Bayar') !!}
            {!! Form::text('total_bayar', $model->total_bayar ?? null, ['class' => 'form-control rupiah']) !!}
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
          <a href="{{ route('kurban.show', $kurban->id) }}" class="btn btn-sm btn-secondary mx-2"><i class="align-middle"
              data-feather="arrow-left-circle "></i> Kembali</a>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
