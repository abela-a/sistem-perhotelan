<?php
include '../templates/header.php';
$judul = 'Data Jasa';
include '../templates/navadmin.php';

// QUERY JASA
$query_jasa = mysqli_query($db, "SELECT * FROM jasa ORDER BY kode_jasa DESC");
// NOMOR URUT UNTUK TABEL
$no = 1;
?>
<div class="container mt-4 py-3 px-5 bg-white rounded shadow-sm border border-warning">
  <div class="clearfix">
    <h1 class="display-4 font-weight-bold text-warning float-left">
      <?= $judul; ?>
    </h1>
    <button class="btn shadow-none btn-primary float-right mt-3" data-toggle="modal" data-target="#TambahJasa">
      <i class="fas fa-briefcase fa-fw"></i>
      Tambah Jasa
    </button>
  </div>
</div>
<div class="container mt-4 bg-white rounded p-5 shadow-sm">

  <?php Alert(); ?>

  <table class="table align-items-center table-bordered mt-4" id="datatables">
    <thead class="thead-light">
      <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">Kode Jasa</th>
        <th scope="col" class="text-center">Jasa</th>
        <th scope="col" class="text-center">Unit Jasa</th>
        <th scope="col" class="text-center">Harga Jasa</th>
        <th scope="col" class="text-center" style="width:10px"></th>
      </tr>
    </thead>
    <tbody>
      <?php while ($jasa = mysqli_fetch_array($query_jasa)) : ?>
        <tr>
          <td class="align-middle"><?= $no++; ?></td>
          <td class="align-middle"><?= $jasa['kode_jasa']; ?></td>
          <td class="align-middle"><?= $jasa['jasa']; ?></td>
          <td class="align-middle"><?= $jasa['unit_jasa']; ?></td>
          <td class="align-middle">Rp. <?= $jasa['harga_jasa']; ?>,-</td>
          <td class="align-middle">
            <button type="button" class="dropdown btn shadow-none btn-sm btn-icon-only" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-fw" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu dropdown-warning dropdown-warning dropdown-menu-right mt-2">
              <button class="dropdown-item" data-toggle="modal" data-target="#EditJasa<?= $jasa['kode_jasa'] ?>">
                <i class="fas fa-edit fa-fw"></i>
                Edit
              </button>
              <button class="dropdown-item" data-toggle="modal" data-target="#HapusJasa<?= $jasa['kode_jasa'] ?>">
                <i class="fas fa-trash fa-fw"></i>
                Hapus
              </button>
            </div>
          </td>
        </tr>

        <!-- MODAL EDIT -->
        <div class="modal fade" id="EditJasa<?= $jasa['kode_jasa'] ?>" tabindex="-1" role="dialog" aria-labelledby="EditJasaLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="EditJasaLabel">Edit Jasa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="../../models/updates/u_jasa.php" method="POST">
                <div class="modal-body grey lighten-4 lighten-5 px-5">
                  <div class="form-group">
                    <label for="kode_jasa">Kode Jasa</label>
                    <input type="text" class="form-control" id="kode_jasa" name="kode_jasa" autocomplete="off" readonly value="<?= $jasa['kode_jasa'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="jasa">Jasa</label>
                    <input type="text" class="form-control" id="jasa" name="jasa" autocomplete="off" value="<?= $jasa['jasa'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="unit_jasa">Unit Jasa</label>
                    <select class="form-control browser-default" id="unit_jasa" name="unit_jasa">
                      <option selected disabled>Pilih Unit Jasa</option>
                      <option <?php if ($jasa['unit_jasa'] == 'Kebersihan') echo 'selected' ?>>Kebersihan</option>
                      <option <?php if ($jasa['unit_jasa'] == 'Keamanan') echo 'selected' ?>>Keamanan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="harga_jasa">Harga Jasa</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                      </div>
                      <input type="number" class="form-control" id="harga_jasa" name="harga_jasa" autocomplete="off" value="<?= $jasa['harga_jasa'] ?>">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn shadow-none btn-outline-primary" data-dismiss="modal">Keluar</button>
                  <button type="submit" class="btn shadow-none btn-primary">Edit Jasa</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /MODAL EDIT -->

        <!-- MODAL HAPUS -->
        <div class="modal fade" id="HapusJasa<?= $jasa['kode_jasa'] ?>" tabindex="-1" role="dialog" aria-labelledby="HapusJasaLabel" aria-hidden="true">
          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">

              <div class="modal-header">
                <h6 class="modal-title" id="HapusJasaLabel">Hapus Jasa</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <form action="../../models/deletes/d_jasa.php" method="POST">
                <div class="modal-body">

                  <div class="py-3 text-center">
                    <i class="fa fa-trash fa-fw fa-3x" aria-hidden="true"></i>
                    <h4 class="heading mt-4">Apakah Anda yakin akan menghapus?</h4>
                    <p>
                      Data jasa "<?= $jasa['jasa']; ?>" dengan kode <u><?= $jasa['kode_jasa']; ?></u> dalam unit jasa <u><?= $jasa['unit_jasa']; ?></u> seharga Rp. <?= $jasa['harga_jasa']; ?>,-
                    </p>
                  </div>

                </div>

                <div class="modal-footer">
                  <input type="hidden" name="kode_jasa" value="<?= $jasa['kode_jasa'] ?>">
                  <button type="submit" class="btn shadow-none btn-white">Ok, Hapus</button>
                  <button type="button" class="btn shadow-none btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /MODAL HAPUS -->
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="TambahJasa" tabindex="-1" role="dialog" aria-labelledby="TambahJasaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahJasaLabel">Tambah Jasa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../models/saves/s_jasa.php" method="POST">
        <div class="modal-body grey lighten-4 lighten-5 px-5">
          <div class="form-group">

            <?php
            $query_autonumber = mysqli_query($db, "SELECT * FROM jasa ORDER BY kode_jasa DESC LIMIT 1");

            if (mysqli_num_rows($query_autonumber) > 0) {
              $latestKD = mysqli_fetch_assoc($query_autonumber);
              $kode_jasa = autonumber($latestKD['kode_jasa'], 5, 5);
            } else {
              $kode_jasa = 'JASA-00001';
            }

            ?>

            <label for="kode_jasa">Kode Jasa</label>
            <input type="text" class="form-control" id="kode_jasa" name="kode_jasa" autocomplete="off" readonly value="<?= $kode_jasa ?>">
          </div>
          <div class="form-group">
            <label for="jasa">Jasa</label>
            <input type="text" class="form-control" id="jasa" name="jasa" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="unit_jasa">Unit Jasa</label>
            <select class="form-control browser-default" id="unit_jasa" name="unit_jasa">
              <option selected disabled>Pilih Unit Jasa</option>
              <option>Keimanan</option>
              <option>Kebersihan</option>
              <option>Kekeluargaan</option>
              <option>Keamanan</option>
              <option>Ketertiban</option>
            </select>
          </div>
          <div class="form-group">
            <label for="harga_jasa">Harga Jasa</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" class="form-control" id="harga_jasa" name="harga_jasa" autocomplete="off" auto>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn shadow-none btn-outline-primary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn shadow-none btn-primary">Simpan Jasa</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /MODAL TAMBAH -->

<?php include '../templates/footer.php' ?>