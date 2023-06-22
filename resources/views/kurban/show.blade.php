@extends('layouts.app_adminkit')

@section('content')
  <div class="row">
    <div class="col text-center fw-bold text-uppercase">
      <h1 class="h1 fw-bold text-uppercase">{{ $title }}</h1>
      <hr>
    </div>
  </div>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h3 class="fw-bold">Tahun Kurban: {{ $model->tahun_hijriah . '/' . $model->tahun_masehi }}</h3>
        <a href="{{ route('kurban.show', [$model->id, 'output' => 'laporan']) }}"><i class="align-middle"
            data-feather="file-text"></i> Laportan Peserta Kurban</a>
      </div>
      <h6><i class="align-middle" data-feather="calendar"></i> Tanggal Akhir Pendaftaran:
        <b>{{ $model->tanggal_akhir_pendaftaran->translatedFormat('l, d-m-Y') }}</b>
      </h6>
      <h6 class="text-muted text-sm"><i class="align-middle" data-feather="user"></i> Created By:
        <b>{{ $model->createdBy->name }}, {{ $model->created_at->diffForHumans() }}</b>
      </h6>
      <p class="mt-2">
        {!! $model->konten !!}
      </p>

      <hr>

      <!-- Daftar hewan kurban -->
      <h4>Data Hewan Kurban</h4>

      @if ($model->kurbanHewan->count() >= 1)
        <div class="text-start">
          <a href="{{ route('kurban-hewan.create', ['kurban_id' => $model->id]) }} "
            class="btn btn-sm btn-primary mb-2">Buat
            Baru</a>
        </div>
      @endif

      @if ($model->kurbanHewan->count() == 0)
        <div class="text-center">
          Belum ada data. <a href="{{ route('kurban-hewan.create', ['kurban_id' => $model->id]) }} ">Buat
            Baru</a>
        </div>
      @else
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>HEWAN</th>
                <th>IURAN</th>
                <th>HARGA</th>
                <th>BIAYA OPS</th>
                <th>CRETED BY</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($model->kurbanHewan as $data)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->hewan }} ({{ $data->kriteria }})</td>
                  <td>{{ formatRupiah($data->iuran_perorang, true) }}</td>
                  <td>{{ formatRupiah($data->harga, true) }}</td>
                  <td>{{ formatRupiah($data->biaya_operasional, true) }}</td>
                  <td>{{ $data->createdBy->name }}</td>
                  <td width='10%' class="text-center">
                    <div class="">
                      <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Action
                      </button>
                      <ul class="dropdown-menu border-0 shadow">
                        <li>
                          <a href="{{ route('kurban-hewan.edit', [$data->id, 'kurban_id' => $data->kurban_id]) }}"
                            class="dropdown-item">Edit</a>
                        </li>
                        <li>
                          <!-- Tombol Delete -->
                          {!! Form::open([
                              'method' => 'DELETE',
                              'route' => ['kurban-hewan.destroy', [$data->id, 'kurban_id' => $data->kurban_id]],
                              'style' => 'display.inline',
                          ]) !!}
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                          {!! Form::close() !!}
                          <!-- Tombol Delete -->
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
      <!-- Daftar hewan kurban end -->

      <hr>

      <!-- Daftar peserta -->
      <h4>Data Peserta Kurban</h4>

      @if ($model->kurbanPeserta->count() >= 1)
        <div class="text-start">
          <a href="{{ route('kurban-peserta.create', ['kurban_id' => $model->id]) }} "
            class="btn btn-sm btn-primary mb-2">Buat
            Baru</a>
        </div>
      @endif

      @if ($model->kurbanPeserta->count() == 0)
        <div class="text-center">
          Belum ada data peserta. <a href="{{ route('kurban-peserta.create', ['kurban_id' => $model->id]) }} ">Buat
            Pendaftaran Baru</a>
        </div>
      @else
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>NAMA</th>
                <th>NO. HP</th>
                <th>ALAMAT</th>
                <th>JENIS HEWAN</th>
                <th class="text-center" width="13%">STATUS PEMBAYARAN</th>
                <th class="text-center" colspan="2">AKSI</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($model->kurbanPeserta as $data)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    <div>{{ $data->peserta->nama }}</div>
                    <div>({{ $data->peserta->nama }})</div>
                  </td>
                  <td>{{ $data->peserta->nohp }}</td>
                  <td>{{ $data->peserta->alamat }}</td>
                  <td>
                    {{ Str::ucfirst($data->kurbanHewan->hewan) }} -
                    {{ $data->kurbanHewan->kriteria }} -
                    {{ $data->kurbanHewan->iuran_perorang }}
                  </td>
                  <td class="text-center">
                    <span class="badge bg-{{ $data->status_bayar == 'lunas' ? 'success' : 'warning' }}">
                      {{ $data->getStatusTeks() }}
                    </span>
                  </td>
                  <td class="text-center">
                    @if ($data->status_bayar == 'belum')
                      <a class="btn btn-sm btn-primary"
                        href="{{ route('kurban-peserta.edit', [$data->id, 'kurban_id' => $data->kurban_id]) }}"
                        class="dropdown-item">Pembayaran</a>
                    @else
                      {{ $data->getStatusTeks() }}
                    @endif
                  </td>
                  <td class="text-center">

                    <!-- Tombol Delete -->
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['kurban-peserta.destroy', [$data->id, 'kurban_id' => $data->kurban_id]],
                    ]) !!}
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger mx-2"
                      onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                    {!! Form::close() !!}
                    <!-- Tombol Delete -->
                  </td>

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
      <!-- Daftar peserta ende-->
    </div>
  </div>
@endsection
