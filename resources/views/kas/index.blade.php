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
      <h1 class="h1 fw-bold">Kas {{ auth()->user()->masjid->nama }}</h1>
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
        <a href="{{ route('kas.create') }}" class="d-block btn btn-primary fw-bold d-flex align-items-center"><i
            class="align-middle me-2" data-feather="plus-circle"></i> Tambah Data Kas</a>
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
        <label for="q">Keterangan transaski</label>
        <div class="input-group">
          {!! Form::text('q', request('q'), [
              'class' => 'form-control',
              'placeholder' => 'Keterangan Transaksi',
              'id' => 'q',
          ]) !!}
          <button class="btn btn-primary fw-bold  d-flex align-items-center" type="submit" id="button-addon2"><i
              class="align-middle me-2" data-feather="search"></i> CARI</button>
          {{-- <button id="cetak" class="btn btn-primary fw-bold d-flex align-items-center "target="blank"
            type="button"><i class="align-middle me-2" data-feather="printer"></i> CETAK
            LAPORAN</button> --}}
        </div>
      </div>
      {!! Form::close() !!}
    </div>
    <div class="card-body table-responsive">
      <table class="{{ config('app.table_style') }}">
        <thead>
          <tr>
            <th width="1%">NO.</th>
            <th>Diinput Oleh</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th class="text-end">Pemasukan</th>
            <th class="text-end">Pengeluaran</th>
            <th class="text-end">Saldo</th>
            <th class="text-center" width="12%">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($kas as $data)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>{{ $data->createdBy->name }}</td>
              <td>{{ $data->tanggal->translatedFormat('l, d-m-Y') }}</td>
              <td>{{ $data->keterangan }}</td>
              <td class="text-end">
                <span class="badge bg-success">
                  {{ $data->jenis == 'masuk' ? formatRupiah($data->jumlah, true) : '-' }}
                </span>
                {{-- <span class="badge {{ $data->jenis == 'keluar' ? 'bg-danger' : 'bg-success' }}">{{ Str::ucfirst($data->jenis) }}</span> --}}
              </td>
              <td class="text-end">
                <span
                  class="badge bg-danger">{{ $data->jenis == 'keluar' ? formatRupiah($data->jumlah, true) : '-' }}</span>
              </td>

              <td class="text-end">{{ formatRupiah($data->saldo, true) }}</td>
              <td class="d-flex justify-content-center gap-2">
                <a href="{{ route('kas.show', $data->id) }}" class="btn rounded btn-warning btn-sm"><i
                    class="align-middle" data-feather="eye"></i></a>
                <a href="{{ route('kas.edit', $data->id) }}" class="btn rounded btn-success btn-sm"><i
                    class="align-middle" data-feather="edit"></i> </a>

                <!-- Tombol Delete -->
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['kas.destroy', $data->id],
                    'style' => 'display.inline',
                ]) !!}
                @csrf
                @method('DELETE')
                <button type="submit" class="btn rounded btn-danger btn-sm"
                  onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="align-middle"
                    data-feather="x-circle"></i> </button>
                {!! Form::close() !!}
                <!-- Tombol Delete -->
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="text-center fw-bold">Total</td>
            <td class="text-end">{{ formatRupiah($totalPemasukan, true) }}</td>
            <td class="text-end">{{ formatRupiah($totalPengeluaran, true) }}</td>
            <td class="text-end">{{ formatRupiah($saldoAkhir, true) }}</td>
            <td align="center"> <button id="cetak"
                class="btn  text-center btn-primary fw-bold d-flex align-items-center "target="blank" type="button"><i
                  class="align-middle me-2" data-feather="printer"></i> CETAK
                LAPORAN</button></td>
          </tr>
        </tfoot>
      </table>
      <h3 class="text-black">Saldo Akhir: <span class="badge bg-secondary">{{ formatRupiah($saldoAkhir, true) }}</span>
      </h3>
      {{ $kas->links() }}
    </div>
  </div>
@endsection
