<?php

function formatRupiah($nominal, $prefix = false)
{
  if ($prefix) {
    return "Rp. " . number_format($nominal, 0, ',', '.');
  }
  return number_format($nominal, 0, ",", ".");
}


if (!function_exists('satuan')) {
  function satuan($jumlah, $satuan, $jenis)
  {
    return $jenis == 'uang' ? formatRupiah($jumlah, true) : $jumlah . ' ' . $satuan;
  }
}

function functionAngkaToBulan($angka)
{
  $bulanArray = [
    '1' => 'Januari',
    '2' => 'Februari',
    '3' => 'Maret',
    '4' => 'April',
    '5' => 'Mei',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'Agustus',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
  ];

  return $bulanArray[$angka + 0];
}