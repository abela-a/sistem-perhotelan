<?php
include '../../config/config.php';

$id_tamu = $_POST['id_tamu'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$pekerjaan = $_POST['pekerjaan'];
$telepon = $_POST['telepon'];

$query_simpan_tamu = "INSERT INTO tamu(
                    id_tamu, 
                    nama, 
                    alamat, 
                    pekerjaan, 
                    telepon) 
                    VALUES(
                      '$id_tamu',
                      '$nama',
                      '$alamat',
                      '$pekerjaan',
                      '$telepon'
                      )";
$simpan_tamu = mysqli_query($db, $query_simpan_tamu);

if ($simpan_tamu) {
  buatAlert('Tamu berhasil ditambahkan!', 'success');
  header('Location:../../views/admin/tamu.php');
} else {
  buatAlert('Tamu gagal ditambahkan!', 'danger');
  header('Location:../../views/admin/tamu.php');
}
