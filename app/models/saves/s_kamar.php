<?php
include '../../config/config.php';

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
  header('Location:../../views/admin/v_kamar.php');
} else {
  buatAlert('Kamar gagal ditambahkan!', 'danger');
  header('Location:../../views/admin/v_kamar.php');
}
