<title><?= $judul; ?></title>
<nav class="navbar navbar-expand-lg navbar-dark bg-default">
  <div class="container">
    <a class="navbar-brand" href="#">
      <i class="fas fa-hotel fa-fw"></i>&nbsp;
      HOTEL BAPAK KAO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-primary" aria-controls="navbar-primary" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-primary">
      <div class="navbar-collapse-header">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="./index.html">
              <img alt="image" src="./assets/img/brand/blue.png">
            </a>
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
        <li class="nav-item">
          <a class="nav-link" href="#">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbar-primary_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tamu</a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-primary_dropdown_1">
            <a class="dropdown-item" href="#">Sedang Berlangsung</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Check-In</a>
            <a class="dropdown-item" href="#">Check-Out</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbar-primary_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Input Data</a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-primary_dropdown_1">
            <a class="dropdown-item" href="#">Jasa</a>
            <a class="dropdown-item" href="#">Kamar</a>
            <a class="dropdown-item" href="#">Tamu</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>