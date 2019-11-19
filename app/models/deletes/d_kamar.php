<?php
include '../../config/config.php';

$kode_kamar = $_POST['kode_kamar'];

$query_hapus_kamar = "DELETE FROM kamar WHERE kode_kamar = '$kode_kamar'";
$hapus_kamar = mysqli_query($db, $query_hapus_kamar);

if ($hapus_kamar) {
  buatAlert('Kamar berhasil dihapus!', 'success', 'fas fa-trash');
  header('Location:../../views/admin/kamar.php');
} else {
  buatAlert('Kamar gagal dihapus!', 'danger', 'fas fa-trash');
  header('Location:../../views/admin/kamar.php');
}
