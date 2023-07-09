@extends('layouts.app_adminkit')

@section('js')
  {{-- <script src="{{ $chart->cdn() }}"></script>
  {{ $chart->script() }} --}}
  <script src="{{ asset('apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('apexcharts/apexcharts.css') }}"></script>

  <script>
    var options = {
      series: [{
        name: "Total Infaq",
        data: @json($dataTotalInfaq)
      }],
      chart: {
        height: 280,
        type: 'line',
        zoom: {
          enabled: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight'
      },
      title: {
        text: 'Data Total Infaq Perbulan',
        align: 'left'
      },
      grid: {
        row: {
          colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },
      },
      xaxis: {
        categories: @json($dataBulan)
      },
      yaxis: {
        labels: {
          formatter: function(value) {
            return value.toLocaleString('id-ID', {
              style: "currency",
              currency: "IDR"
            })
          }
        }
      }
    };
    var totalInfaq = @json($dataTotalInfaq);
    var convert = totalInfaq.map((value) => {
      return parseInt(value);
    })
    var options_dua = {
      series: convert,
      chart: {
        width: 380,
        type: 'pie',
      },
      labels: @json($dataBulan),
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },

          legend: {
            position: 'bottom'
          }
        }
      }],

      yaxis: {
        labels: {
          formatter: function(value) {
            return value.toLocaleString('id-ID', {
              style: "currency",
              currency: "IDR"
            })
          }
        }
      }
    };

    var chart_dua = new ApexCharts(document.querySelector("#chart_dua"), options_dua);
    chart_dua.render();

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
    console.log(convert);
    console.log(totalInfaq);
  </script>
@endsection

@section('title', 'Beranda')

@section('content')
  <div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard Masjid {{ auth()->user()->masjid->nama }}</h1>
    <div class="row">
      <div class="col-xl-6 col-xxl-5 d-flex">
        <div class="w-100">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col mt-0">
                      <h5 class="card-title">Saldo Akhir</h5>
                    </div>
                    <div class="col-auto">
                      <div class="stat text-primary">
                        <i class="align-middle" data-feather="truck"></i>
                      </div>
                    </div>
                  </div>
                  <h1 class="mt-1 mb-3">{{ formatRupiah($saldoAkhir, true) }}</h1>
                  <div class="mb-0">
                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                    <span class="text-muted">Since last week</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col mt-0">
                      <h5 class="card-title">Total Infaq Hari Ini</h5>
                    </div>

                    <div class="col-auto">
                      <div class="stat text-primary">
                        <i class="align-middle" data-feather="dollar-sign"></i>
                      </div>
                    </div>
                  </div>
                  <h1 class="mt-1 mb-3">{{ formatRupiah($totalInfaq, true) }}</h1>
                  <div class="mb-0">
                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65% </span>
                    <span class="text-muted">Since last week</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6 col-xxl-7">
        <div class="card flex-fill w-100">
          <div class="card-header">
            <h5 class="card-title mb-0">Grafi Infaq Bulanan</h5>
          </div>
          <div class="card-body py-3">
            {{-- Menggunakan larape --}}
            {{-- {!! $chart->container() !!} --}}

            {{-- Menggunakan apexcharts --}}
            <div id="chart"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-8  d-flex">
        <div class="card flex-fill">
          <div class="card-header">
            <h5 class="card-title mb-0">Transaksi Kas Terbaru</h5>
          </div>
          <table class="table table-hover my-0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Keterangan</th>
                <th class="d-none d-xl-table-cell">Tanggal Transaksi</th>
                <th class="d-none d-xl-table-cell">Jenis</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($kas as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->keterangan }}</td>
                  <td class="d-none d-xl-table-cell">{{ $item->tanggal->translatedFormat('l, d-m-Y') }}
                  </td>
                  <td><span class="badge bg-success">{{ $item->jenis }}</span></td>
                  <td class="d-none d-xl-table-cell">{{ formatRupiah($item->jumlah, true) }}</td>
                </tr>
              @empty
                <td colspan="5">Data kas tidak ada</td>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-12 col-lg-4 col-xxl-4 d-flex">
        <div class="card flex-fill w-100">
          <div class="card-header">
            <h5 class="card-title mb-0">Data Infaq Perbulan</h5>
          </div>
          <div class="card-body d-flex w-100">
            <div class="align-self-center chart chart-lg">
              {{-- <canvas id="chartjs-dashboard-bar"></canvas> --}}
              <div id="chart_dua"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
