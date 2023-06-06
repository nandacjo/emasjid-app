@extends('layouts.app_adminkit')

@section('content')
    <div class="row">
        <div class="col text-center fw-bold text-uppercase">
            <h1 class="h1 fw-bold">Kas {{ auth()->user()->masjid->nama }}</h1>
            <hr>
        </div>
    </div>
    {{-- <div class="col-md-6">
    <h2 class="h3">Data Kas {{ auth()->user()->masjid->nama }}</h2>
  </div> --}}

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            {!! Form::open([
                'url' => url()->current(),
                'method' => 'GET',
                'class' => 'row align-items-center',
            ]) !!}
            <div class="col-auto ">
                <label></label>
                <a href="{{ route('kas.create') }}" class="d-block btn btn-primary">Tambah Data Kas</a>
            </div>
            <div class="col-auto ms-auto">
                <label for="tanggal_transaksi">Tanggal Transaksi</label>
                {!! Form::date('tanggal', request('tanggal'), [
                    'class' => 'form-control',
                ]) !!}
            </div>
            <div class="col-auto">
                <label for="q">Keterangan transaski</label>
                <div class="input-group">
                    {!! Form::text('q', request('q'), [
                        'class' => 'form-control',
                        'placeholder' => 'Keterangan Transaksi',
                        'id' => 'q',
                    ]) !!}
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="card-body table-responsive">
            <table class="{{ config('app.table_style') }}">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Diinput Oleh</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th class="text-end">Pemasukan</th>
                        <th class="text-end">Pengeluaran</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kas as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tanggal->translatedFormat('D, d-m-Y') }}</td>
                            <td>{{ $data->createdBy->name }}</td>
                            <td>{{ $data->kategori ?? 'Umum' }}</td>
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
                            {{-- <td>{{ formatRupiah($data->masjid->saldo_akhir, true) }}</td> --}}
                            <td class="d-flex gap-2">
                                <a href="{{ route('kas.show', $data->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                <a href="{{ route('kas.edit', $data->id) }}" class="btn btn-secondary btn-sm">Edit</a>

                                <!-- Tombol Delete -->
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['kas.destroy', $data->id],
                                    'style' => 'display.inline',
                                ]) !!}
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                {!! Form::close() !!}
                                <!-- Tombol Delete -->

                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-center fw-bold">Total</td>
                        <td class="text-end">{{ formatRupiah($totalPemasukan, true) }}</td>
                        <td class="text-end">{{ formatRupiah($totalPengeluaran, true) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <h3 class="text-black">Saldo Akhir: <span class="badge bg-info">{{ formatRupiah($saldoAkhir, true) }}</span>
            </h3>
            {{ $kas->links() }}
        </div>
    </div>
@endsection
