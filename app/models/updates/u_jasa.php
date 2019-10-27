<?php
include '../../config/config.php';

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
  header('Location:../../views/admin/v_jasa.php');
} else {
  buatAlert('Jasa gagal diubah!', 'danger', 'fas fa-edit');
  header('Location:../../views/admin/v_jasa.php');
}
