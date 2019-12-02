<?php

include '../config/connection.php';
include '../config/autoload.php';

if (isset($_POST['save'])) {
  $kode_tagihan = $_POST['kode_tagihan'];
  $id_tamu = $_POST['id_tamu'];
  $kode_kamar = $_POST['kode_kamar'];
  $kode_jasa = $_POST['kode_jasa'];
  $total_tagihan = $_POST['total_tagihan'];

  $query_update_kamar = "UPDATE kamar SET status_kamar = 'Kosong' WHERE kode_kamar = '$kode_kamar'";
  $simpan_update_kamar = mysqli_query($db, $query_update_kamar);

  $query_update_tamu = "UPDATE tamu SET status_tamu = 'Check Out' WHERE id_tamu = '$id_tamu'";
  $simpan_update_tamu = mysqli_query($db, $query_update_tamu);

  $query_simpan_tagihan = "INSERT INTO tagihan VALUES(
                '$kode_tagihan',
                '$id_tamu',
                '$kode_kamar',
                '$kode_jasa',
                '$total_tagihan'
                )";
  $simpan_tagihan = mysqli_query($db, $query_simpan_tagihan);

  if ($simpan_tagihan && $simpan_update_kamar && $simpan_update_tamu) {
    buatAlert('Tamu berhasil check out!', 'success');
    header('Location:../../admin/tagihan.php');
  } else {
    buatAlert('Tamu gagal check out!', 'danger');
    header('Location:../../admin/tagihan.php');
  }
}

if (isset($_POST['update'])) { }

if (isset($_POST['delete'])) { }
