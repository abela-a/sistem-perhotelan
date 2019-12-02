<?php
include '../../config/connection.php';
$id = $_GET['id'];
// QUERY TAGIHAN
$query_tamu = mysqli_query($db, "SELECT * FROM view_tamu WHERE id_tamu = '$id'");
$tamu = mysqli_fetch_assoc($query_tamu);
?>

<div class="form-group">
  <label>Kamar</label>
  <input type="hidden" name="kode_kamar" value="<?= $tamu['kode_kamar'] ?>">
  <input type="text" class="form-control" readonly value="<?= $tamu['kode_kamar'] . ' | ' . $tamu['kamar'] ?>">
</div>

<div class="form-group">
  <label>Tarif Kamar Perhari</label>
  <input type="text" class="form-control kamar" readonly value="<?= $tamu['harga_kamar'] ?>">
</div>

<div class="form-group">
  <label>Jasa</label>
  <input type="hidden" name="kode_jasa" value="<?= $tamu['kode_jasa'] ?>">
  <input type="text" class="form-control" readonly value="<?= $tamu['kode_jasa'] . ' | ' . $tamu['jasa'] ?>">
</div>

<div class="form-group">
  <label>Tarif Jasa Perhari</label>
  <input type="text" class="form-control jasa" readonly value="<?= $tamu['harga_jasa'] ?>">
</div>

<div class="form-group">
  <label>Tanggal Check In</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text"><span class="fas fa-calendar-alt"></span></span>
    </div>
    <input type="text" class="form-control datepicker" readonly data-value="<?= $tamu['tanggal_check_in'] ?>">
  </div>
</div>

<div class="form-group">
  <label>Tanggal Check Out</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text"><span class="fas fa-calendar-alt"></span></span>
    </div>
    <input type="text" class="form-control datepicker" readonly data-value="<?= $tamu['tanggal_check_out'] ?>">
  </div>
</div>

<div class="form-group">
  <label>Lama Menginap</label>
  <div class="input-group mb-3">
    <input type="number" readonly class="form-control hari" value="<?= $tamu['hari'] ?>">
    <div class="input-group-prepend">
      <span class="input-group-text">Hari</span>
    </div>
  </div>
</div>

<div class="form-group">
  <label>Total Tagihan</label>
  <input type="text" name="total_tagihan" readonly class="form-control">
</div>

<script>
  $(document).ready(function() {
    let hari = parseInt($('.hari').val());
    let jasa = parseInt($('.jasa').val());
    let kamar = parseInt($('.kamar').val());

    let hasilkamar = hari * kamar;
    let hasiljasa = hari * jasa;
    let hasil = hasilkamar + hasiljasa;

    $('input[name="total_tagihan"]').val(hasil);
  })
</script>