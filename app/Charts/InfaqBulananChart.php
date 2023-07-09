<?php

namespace App\Charts;

use App\Models\Infaq;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class InfaqBulananChart
{
  protected $chart;

  public function __construct(LarapexChart $chart)
  {
    $this->chart = $chart;
  }

  public function build(): \ArielMejiaDev\LarapexCharts\LineChart
  {
    $tahun = date('Y');
    $bulan = date('m');
    for ($i = 1; $i <= $bulan; $i++) {

      $totalInfaq = Infaq::userMasjid()->whereYear('created_at', $tahun)->whereMonth('created_at', $i)->sum('jumlah');
      // $dataBulan[] = Carbon::create()->month($i)->format('F'); // mengubah angka menjadi nama bulan
      $dataBulan[] = functionAngkaToBulan($i);
      $dataTotalInfaq[] = $totalInfaq;
    }
    // dd($dataTotalInfaq);
    return $this->chart->lineChart()
      ->setTitle('Data infaq bulanan')
      ->setSubtitle('Total penerimaan infaq setiap bulan.')
      ->addData('Total Infaq', $dataTotalInfaq)
      ->setHeight(280)
      ->setXAxis($dataBulan);
  }
}
