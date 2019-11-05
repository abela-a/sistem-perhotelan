<?php

function autonumber($id_terakhir, $panjang_kode, $panjang_angka)
{
  // Mengambil nilai kode
  $kode = substr($id_terakhir, 0, $panjang_kode);

  // Mengambil nilai angka
  $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);

  // Mengabmbil nilai angka dengan 1
  // Kemudian memberikan string 0 args panjang string angka menjadi 4
  // sehingga menjadi 0006
  $angka_baru = str_repeat("0", $panjang_angka - strlen($angka + 1)) . ($angka + 1);

  // Menggabungkan kode dengan nilai angka baru
  $id_baru = $kode . $angka_baru;

  return $id_baru;
}
