<?php

namespace App\Http\Controllers;

use App\Charts\InfaqBulananChart;
use App\Models\Infaq;
use App\Models\Kas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(InfaqBulananChart $chart)
  {
    $tahun = date('Y');
    $bulan = date('m');
    for ($i = 1; $i <= $bulan; $i++) {

      $totalInfaq = Infaq::userMasjid()->whereYear('created_at', $tahun)->whereMonth('created_at', $i)->sum('jumlah');
      // $dataBulan[] = Carbon::create()->month($i)->format('F'); // mengubah angka menjadi nama bulan
      $dataBulan[] = functionAngkaToBulan($i);
      $dataTotalInfaq[] = $totalInfaq;
    }
    $data['dataBulan'] = $dataBulan;
    $data['dataTotalInfaq'] = $dataTotalInfaq;
    // $data['chart'] = $chart->build(); menggunakan larapex untuk membuat chart
    $data['saldoAkhir']  = Kas::SaldoAkhir();
    $data['totalInfaq'] = Infaq::userMasjid()->whereDate('created_at', now()->format('Y-m-d'))->sum('jumlah');
    $data['kas'] = Kas::userMasjid()->latest()->take(7)->get();
    return view('home', $data);
  }
}
