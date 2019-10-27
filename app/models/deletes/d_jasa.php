<?php
include '../../config/config.php';

$kode_jasa = $_POST['kode_jasa'];

$query_hapus_jasa = "DELETE FROM jasa WHERE kode_jasa = '$kode_jasa'";
$hapus_jasa = mysqli_query($db, $query_hapus_jasa);

if ($hapus_jasa) {
  header('Location:../../views/admin/v_jasa.php');
}
