<?php
include '../app/views/templates/header.php';

if (isset($_SESSION['login'])) {
  buatAlert('Anda telah login!', 'warning', 'fas fa-info-circle');
  header('Location:../admin/dashboard.php');
  exit;
}

?>

<style>
  #login-register-img {
    height: 100vh;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>

<div id="login-register-img" style="background-image: url(http:/localhost/db_hotel/public/img/assets/bg.png);">
  <div class="rgba-white-strong h-100">
    <div class="container">
      <div class="row justify-content-md-center no-gutters">
        <div class="col-md-5 mt-5 shadow-lg mb-0">

          <div class="card-image h-100" style="background-image: url(http:/localhost/db_hotel/public/img/assets/card.jpg);">
            <div class="text-white text-center flex-center rgba-indigo-strong py-5 px-4">
              <div>
                <a class="text-white py-0" href="../index.php">
                  <span style="font-size:25px" class="font-weight-bold">Abidzar</span>
                  <span style="font-size:18px" class="font-weight-thin">Hotel</span>
                </a>
                <h1 class="mt-5">
                  SELAMAT
                  <br> DATANG
                  <br> KEMBALI
                </h1>
                <p class="mt-4 px-3">Kami selalu berkomitmen untuk memberikan pelayanan terbaik dengan kamar yang terawat dan fasilitas yang memadai.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5 mt-5 shadow-lg h-100">
          <!-- BODY -->
          <form action="../app/models/AuthModel.php" method="post">
            <div class="grey lighten-5 py-4 px-5">

              <div class="pb-5 pt-3 px-3 text-center">
                <span class="text-center h3 text-primary font-weight-medium">LOGIN PAGE</span>
              </div>

              <?php Alert(); ?>

              <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" id="username" autofocus required autocomplete="off">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group" id="showhidepass">
                  <input class="form-control" type="Password" name="password" id="password" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <a href="#"><i class="fa fa-fw fa-eye" aria-hidden="true"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary btn-block my-5" type="submit" name="login">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '../app/views/templates/footer.php'; ?>

<script>
  // SHOWHIDEPASS
  $("#showhidepass a").on("click", function(event) {
    event.preventDefault();
    if ($("#showhidepass input").attr("type") == "text") {
      $("#showhidepass input").attr("type", "Password");
      $("#showhidepass i").addClass("fa-eye");
      $("#showhidepass i").removeClass("fa-eye-slash");
    } else if ($("#showhidepass input").attr("type") == "Password") {
      $("#showhidepass input").attr("type", "text");
      $("#showhidepass i").removeClass("fa-eye");
      $("#showhidepass i").addClass("fa-eye-slash");
    }
  });
</script>