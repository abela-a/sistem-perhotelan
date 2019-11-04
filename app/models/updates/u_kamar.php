<?php
include '../../config/config.php';

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
  header('Location:../../views/admin/v_kamar.php');
} else {
  buatAlert('Kamar gagal diubah!', 'danger', 'fas fa-edit');
  header('Location:../../views/admin/v_kamar.php');
}
