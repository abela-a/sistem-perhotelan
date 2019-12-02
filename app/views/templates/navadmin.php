<title><?= $judul; ?></title>
<nav class="navbar navbar-expand-lg navbar-dark unique-color-dark py-3">
  <div class="container">
    <a class="navbar-brand font-weight-bolder" href="../../../index.php">
      <span class=text-primary>Abidzar</span>Hotel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-primary" aria-controls="navbar-primary" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-primary">
      <div class="navbar-collapse-header">
        <div class="row">
          <div class="col-6 collapse-brand">
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-primary" aria-controls="navbar-primary" aria-expanded="false" aria-label="Toggle navigation">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
      <ul class="navbar-nav ml-lg-auto">
        <li class="nav-item mx-1">
          <a class="nav-link" href="../admin/dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="../admin/tamu.php">Tamu</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="../admin/jasa.php">Jasa</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="../admin/kamar.php">Kamar</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="../admin/tagihan.php">Tagihan</a>
        </li>
      </ul>
    </div>
  </div>
</nav>