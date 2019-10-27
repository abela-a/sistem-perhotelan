<?php
include '../../config/config.php';

$kode_jasa = $_POST['kode_jasa'];

$query_hapus_jasa = "DELETE FROM jasa WHERE kode_jasa = '$kode_jasa'";
$hapus_jasa = mysqli_query($db, $query_hapus_jasa);

if ($hapus_jasa) {
  buatAlert('Jasa berhasil dihapus!', 'success', 'fas fa-trash');
  header('Location:../../views/admin/v_jasa.php');
} else {
  buatAlert('Jasa gagal dihapus!', 'danger', 'fas fa-trash');
  header('Location:../../views/admin/v_jasa.php');
}
