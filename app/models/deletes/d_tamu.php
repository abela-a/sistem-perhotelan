<?php
include '../../config/config.php';

$id_tamu = $_POST['id_tamu'];

$query_hapus_jasa = "DELETE FROM tamu WHERE id_tamu = '$id_tamu'";
$hapus_jasa = mysqli_query($db, $query_hapus_jasa);

if ($hapus_jasa) {
  buatAlert('Tamu berhasil dihapus!', 'success', 'fas fa-trash');
  header('Location:../../views/admin/tamu.php');
} else {
  buatAlert('Tamu gagal dihapus!', 'danger', 'fas fa-trash');
  header('Location:../../views/admin/tamu.php');
}
