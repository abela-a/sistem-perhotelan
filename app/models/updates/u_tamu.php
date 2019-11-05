<?php
include '../../config/config.php';

$id_tamu = $_POST['id_tamu'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$pekerjaan = $_POST['pekerjaan'];
$telepon = $_POST['telepon'];

$query_edit_tamu = "UPDATE tamu SET
                nama = '$nama',
                alamat = '$alamat',
                pekerjaan = '$pekerjaan'
                WHERE id_tamu = '$id_tamu'";
$edit_tamu = mysqli_query($db, $query_edit_tamu);

if ($edit_tamu) {
  buatAlert('Tamu berhasil diubah!', 'success', 'fas fa-edit');
  header('Location:../../views/admin/v_tamu.php');
} else {
  buatAlert('Tamu gagal diubah!', 'danger', 'fas fa-edit');
  header('Location:../../views/admin/v_tamu.php');
}
