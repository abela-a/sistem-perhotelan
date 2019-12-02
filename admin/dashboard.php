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
  </div>
</div>
<div class="container mt-4 bg-white rounded p-5 shadow-sm">

</div>

<?php include '../app/views/templates/footer.php' ?>