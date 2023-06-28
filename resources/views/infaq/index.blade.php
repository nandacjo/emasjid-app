@extends('layouts.app_adminkit')

@section('js')
  <script>
    $(document).ready(function() {
      $('#cetak').click(function(e) {
        var tanggalMulai = $('#tanggal_mulai').val();
        var tanggalSelesai = $('#tanggal_selesai').val();
        var q = $('#q').val();
        var params = "?page=laporan&tanggal_mulai=" + tanggalMulai + "&tanggal_selesai=" + tanggalSelesai +
          "&q=" + q;
        window.open('/kas' + params, 'blank')
      })
    });
  </script>
@endsection

@section('content')
  <div class="row">
    <div class="col text-center fw-bold text-uppercase">
      <h1 class="h1 fw-bold">Infaq {{ auth()->user()->masjid->nama }}</h1>
      <hr>
    </div>
  </div>
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="card-header">
      {!! Form::open([
          'url' => url()->current(),
          'method' => 'GET',
          'class' => 'd-flex',
      ]) !!}
      <div class="me-auto ">
        <label></label>
        <a href="{{ route('infaq.create') }}" class="d-block btn btn-primary">Tambah Data Kas</a>
      </div>
      <div>
        <label for="tanggal_transaksi">Tanggal Mulai</label>
        {!! Form::date('tanggal_mulai', request('tanggal_mulai'), [
            'class' => 'form-control',
            'id' => 'tanggal_mulai',
        ]) !!}
      </div>

      <div class="mx-3">
        <label for="tanggal_selesai">Tanggal Selesai</label>
        {!! Form::date('tanggal_selesai', request('tanggal_selesai'), [
            'class' => 'form-control',
            'id' => 'tanggal_selesai',
        ]) !!}
      </div>

      <div>
        <label for="q">Sumber / Atas Nama</label>
        <div class="input-group">
          {!! Form::text('q', request('q'), [
              'class' => 'form-control',
              'placeholder' => 'Sumber / Atas Nama',
              'id' => 'q',
          ]) !!}
          <button class="btn btn-primary fw-bold" type="submit" id="button-addon2">CARI</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
    <div class="card-body table-responsive">
      <table class="{{ config('app.table_style') }}">
        <thead>
          <tr>
            <th widht="1%" class="text-center">NO.</th>
            <th>Diinput Oleh</th>
            <th>Tanggal</th>
            <th>Sumber</th>
            <th>Jenis</th>
            <th>Keterangan</th>
            <th class="text-end">Jumlah</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($query as $data)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>{{ $data->createdBy->name }}</td>
              <td>{{ $data->created_at->translatedFormat('l, d-m-Y') }}</td>
              <td>{{ $data->sumber }}</td>
              <td>{{ $data->jenis }}</td>
              <td>{{ $data->atas_nama }}</td>
              <td class="text-end">

                {{ satuan($data->jumlah, $data->satuan, $data->jenis) }}

              </td>
              <td class="d-flex justify-content-center gap-2">
                <a href="{{ route('infaq.edit', $data->id) }}" class="btn rounded btn-secondary btn-sm">Edit</a>

                <!-- Tombol Delete -->
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['infaq.destroy', $data->id],
                    'style' => 'display.inline',
                ]) !!}
                @csrf
                @method('DELETE')
                <button type="submit" class="btn rounded btn-danger btn-sm"
                  onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                {!! Form::close() !!}
                <!-- Tombol Delete -->
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      </h3>
      {{ $query->links() }}
    </div>
  </div>
@endsection
