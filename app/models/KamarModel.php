<?php

include '../config/connection.php';
include '../config/autoload.php';

if (isset($_POST['save'])) {
  $kode_kamar = $_POST['kode_kamar'];
  $kamar = $_POST['kamar'];
  $harga_kamar = $_POST['harga_kamar'];

  $query_simpan_kamar = "INSERT INTO kamar VALUES(
                '$kode_kamar',
                '$kamar',
                '$harga_kamar',
                'Kosong'
                )";
  $simpan_kamar = mysqli_query($db, $query_simpan_kamar);

  if ($simpan_kamar) {
    buatAlert('Kamar berhasil ditambahkan!', 'success');
    header('Location:../../admin/kamar.php');
  } else {
    buatAlert('Kamar gagal ditambahkan!', 'danger');
    header('Location:../../admin/kamar.php');
  }
}

if (isset($_POST['update'])) {
  $kode_kamar = $_POST['kode_kamar'];
  $kamar = $_POST['kamar'];
  $harga_kamar = $_POST['harga_kamar'];

  $query_edit_kamar = "UPDATE kamar SET
                kamar = '$kamar',
                harga_kamar = '$harga_kamar'
                WHERE kode_kamar = '$kode_kamar'";
  $edit_kamar = mysqli_query($db, $query_edit_kamar);

  if ($edit_kamar) {
    buatAlert('Kamar berhasil diubah!', 'success', 'fas fa-edit');
    header('Location:../../admin/kamar.php');
  } else {
    buatAlert('Kamar gagal diubah!', 'danger', 'fas fa-edit');
    header('Location:../../admin/kamar.php');
  }
}

if (isset($_POST['delete'])) {
  $kode_kamar = $_POST['kode_kamar'];

  $query_hapus_kamar = "DELETE FROM kamar WHERE kode_kamar = '$kode_kamar'";
  $hapus_kamar = mysqli_query($db, $query_hapus_kamar);

  if ($hapus_kamar) {
    buatAlert('Kamar berhasil dihapus!', 'success', 'fas fa-trash');
    header('Location:../../admin/kamar.php');
  } else {
    buatAlert('Kamar gagal dihapus!', 'danger', 'fas fa-trash');
    header('Location:../../admin/kamar.php');
  }
}
