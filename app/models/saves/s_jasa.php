<?php
include '../../config/config.php';

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
  header('Location:../../views/admin/v_jasa.php');
}
