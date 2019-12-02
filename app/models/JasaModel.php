<?php

include '../config/connection.php';
include '../config/autoload.php';

if (isset($_POST['save'])) {
  $kode_jasa = $_POST['kode_jasa'];
  $jasa = $_POST['jasa'];
  $unit_jasa = $_POST['unit_jasa'];
  $harga_jasa = $_POST['harga_jasa'];

  $query_simpan_jasa = "INSERT INTO jasa VALUES(
                '$kode_jasa',
                '$jasa',
                '$unit_jasa',
                '$harga_jasa'
                )";
  $simpan_jasa = mysqli_query($db, $query_simpan_jasa);

  if ($simpan_jasa) {
    buatAlert('Jasa berhasil ditambahkan!', 'success');
    header('Location:../../admin/jasa.php');
  } else {
    buatAlert('Jasa gagal ditambahkan!', 'danger');
    header('Location:../../admin/jasa.php');
  }
}

if (isset($_POST['update'])) {
  $kode_jasa = $_POST['kode_jasa'];
  $jasa = $_POST['jasa'];
  $unit_jasa = $_POST['unit_jasa'];
  $harga_jasa = $_POST['harga_jasa'];

  $query_edit_jasa = "UPDATE jasa SET
                jasa = '$jasa',
                unit_jasa = '$unit_jasa',
                harga_jasa = '$harga_jasa'
                WHERE kode_jasa = '$kode_jasa'";
  $edit_jasa = mysqli_query($db, $query_edit_jasa);

  if ($edit_jasa) {
    buatAlert('Jasa berhasil diubah!', 'success', 'fas fa-edit');
    header('Location:../../admin/jasa.php');
  } else {
    buatAlert('Jasa gagal diubah!', 'danger', 'fas fa-edit');
    header('Location:../../admin/jasa.php');
  }
}

if (isset($_POST['delete'])) {
  $kode_jasa = $_POST['kode_jasa'];

  $query_hapus_jasa = "DELETE FROM jasa WHERE kode_jasa = '$kode_jasa'";
  $hapus_jasa = mysqli_query($db, $query_hapus_jasa);

  if ($hapus_jasa) {
    buatAlert('Jasa berhasil dihapus!', 'success', 'fas fa-trash');
    header('Location:../../admin/jasa.php');
  } else {
    buatAlert('Jasa gagal dihapus!', 'danger', 'fas fa-trash');
    header('Location:../../admin/jasa.php');
  }
}
