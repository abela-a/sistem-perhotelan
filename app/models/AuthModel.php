<?php
if (!session_id()) session_start();

include '../config/connection.php';
include '../config/autoload.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $query_user = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
  $UserData = mysqli_fetch_assoc($query_user);

  if ($UserData > 0) {
    //CEK PASS
    if ($UserData['password'] == $password) {
      $_SESSION['login'] = [
        'nama' => $UserData['nama'],
        'username' => $UserData['username'],
        'role' => $UserData['role']
      ];
      //JIKA ADMIN
      if ($_SESSION['login']['role'] == 1) {
        buatAlert('Anda berhasil login!', 'success', 'fas fa-user-check');
        header('Location:../../admin/dashboard.php');
        exit;
      }
      // JIKA PELANGGAN
      else {
        buatAlert('Anda berhasil login!', 'success', 'fas fa-user-check');
        header('Location:../../pelanggan/dashboard.php');
        exit;
      }
    } else {
      buatAlert('Password Anda salah!', 'danger', 'fas fa-user-lock');
      header('Location:../../auth/login.php');
      exit;
    }
  } else {
    buatAlert('User tidak ada!', 'warning', 'fas fa-user-slash');
    header('Location:../../auth/login.php');
    exit;
  }
}

if (isset($_POST['logout'])) {
  unset($_SESSION['login']);
  buatAlert('Anda berhasil logout!', 'success', 'fas fa-user-check');
  header('Location:../../auth/login.php');
  exit;
}
