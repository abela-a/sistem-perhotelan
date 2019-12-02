<?php
include '../app/views/templates/header.php';
$judul = "Dashboard";
include '../app/views/templates/navadmin.php';
?>

<div class="container mt-4 py-3 px-5 bg-white rounded shadow-sm border border-istimewa">
  <div class="clearfix">
    <h1 class="display-5 font-weight-bold text-primary float-left mt-1">
      <?= strtoupper($judul); ?>
    </h1>
    <h3 class="float-right mt-2">
      <span class="badge badge-primary">
        <?= $_SESSION['login']['nama'] ?>
      </span>
    </h3>
  </div>
</div>
<div class="container mt-4 bg-white rounded p-5 shadow-sm">
  <?php Alert(); ?>
</div>

<?php include '../app/views/templates/footer.php' ?>