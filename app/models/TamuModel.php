<?php

include '../config/connection.php';
include '../config/autoload.php';

if (isset($_POST['save'])) {
  $id_tamu = $_POST['id_tamu'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $pekerjaan = $_POST['pekerjaan'];
  $telepon = $_POST['telepon'];
  $tanggal_check_in = $_POST['tanggal_check_in_submit'];
  $tanggal_check_out = $_POST['tanggal_check_out_submit'];
  $hari = $_POST['hari'];
  $kode_kamar = $_POST['kamar'];
  $kode_jasa = $_POST['jasa'];
  $status = 'Check In';

  $query_update_kamar = "UPDATE kamar SET status_kamar = 'Terpakai' WHERE kode_kamar = '$kode_kamar'";
  $simpan_update_kamar = mysqli_query($db, $query_update_kamar);

  $query_simpan_tamu = "INSERT INTO tamu
                    VALUES(
                      '$id_tamu',
                      '$nama',
                      '$alamat',
                      '$pekerjaan',
                      '$telepon',
                      '$tanggal_check_in',
                      '$tanggal_check_out',
                      '$hari',
                      '$kode_kamar',
                      '$kode_jasa',
                      '$status'
                      )";
  $simpan_tamu = mysqli_query($db, $query_simpan_tamu);

  if ($simpan_tamu && $simpan_update_kamar) {
    buatAlert('Tamu berhasil ditambahkan!', 'success');
    header('Location:../../admin/tamu.php');
  } else {
    buatAlert('Tamu gagal ditambahkan!', 'danger');
    header('Location:../../admin/tamu.php');
  }
}

if (isset($_POST['update'])) {
  $id_tamu = $_POST['id_tamu'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $pekerjaan = $_POST['pekerjaan'];
  $telepon = $_POST['telepon'];

  $query_edit_tamu = "UPDATE tamu SET
                nama = '$nama',
                alamat = '$alamat',
                pekerjaan = '$pekerjaan',
                telepon = '$telepon'
                WHERE id_tamu = '$id_tamu'";
  $edit_tamu = mysqli_query($db, $query_edit_tamu);

  if ($edit_tamu) {
    buatAlert('Tamu berhasil diubah!', 'success', 'fas fa-edit');
    header('Location:../../admin/tamu.php');
  } else {
    buatAlert('Tamu gagal diubah!', 'danger', 'fas fa-edit');
    header('Location:../../admin/tamu.php');
  }
}

if (isset($_POST['delete'])) {
  $id_tamu = $_POST['id_tamu'];

  $query_hapus_jasa = "DELETE FROM tamu WHERE id_tamu = '$id_tamu'";
  $hapus_jasa = mysqli_query($db, $query_hapus_jasa);

  if ($hapus_jasa) {
    buatAlert('Tamu berhasil dihapus!', 'success', 'fas fa-trash');
    header('Location:../../admin/tamu.php');
  } else {
    buatAlert('Tamu gagal dihapus!', 'danger', 'fas fa-trash');
    header('Location:../../admin/tamu.php');
  }
}
