<?php
include '../templates/header.php';
$judul = 'Data Kamar';
include '../templates/navadmin.php';

// QUERY kamar
$query_kamar = mysqli_query($db, "SELECT * FROM kamar ORDER BY kode_kamar DESC");
// NOMOR URUT UNTUK TABEL
$no = 1;
?>
<div class="container mt-4 py-3 px-5 bg-white rounded shadow-sm border border-warning">
  <div class="clearfix">
    <h1 class="display-4 font-weight-bold text-warning float-left">
      <?= $judul; ?>
    </h1>
    <button class="btn shadow-none btn-primary float-right mt-3" data-toggle="modal" data-target="#TambahKamar">
      <i class="fas fa-bed fa-fw"></i>
      Tambah Kamar
    </button>
  </div>
</div>
<div class="container mt-4 bg-white rounded p-5 shadow-sm">

  <?php Alert(); ?>

  <table class="table align-items-center table-bordered mt-4" id="datatables">
    <thead class="thead-light">
      <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">Kamar</th>
        <th scope="col" class="text-center">Tarif Kamar / Hari</th>
        <th scope="col" class="text-center" style="width:10px"></th>
      </tr>
    </thead>
    <tbody>
      <?php while ($kamar = mysqli_fetch_array($query_kamar)) : ?>
        <tr>
          <td class="align-middle"><?= $no++; ?></td>
          <td class="align-middle">
            <!-- KODE KAMAR -->
            <?= $kamar['kode_kamar']; ?>
            <!-- TIPE KAMAR -->
            <?php if ($kamar['kamar'] == 'VIP') : ?>
              <span class="badge shadow-none badge-warning">
                <?= $kamar['kamar']; ?>
              </span>
            <?php else : ?>
              <span class="badge shadow-none badge-primary">
                <?= $kamar['kamar']; ?>
              </span>
            <?php endif; ?>
            <!-- STATUS KAMAR -->
            <?php if ($kamar['status_kamar'] == 'Kosong') : ?>
              <span class="badge shadow-none badge-success">
                <?= $kamar['status_kamar']; ?>
              </span>
            <?php else : ?>
              <span class="badge shadow-none badge-danger">
                <?= $kamar['status_kamar']; ?>
              </span>
            <?php endif; ?>
          </td>
          <td class="align-middle">Rp. <?= $kamar['harga_kamar']; ?>,-</td>
          <td class="align-middle">
            <button type="button" class="dropdown btn shadow-none btn-sm btn-icon-only" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-fw" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu dropdown-warning dropdown-warning dropdown-menu-right mt-2">
              <button class="dropdown-item" data-toggle="modal" data-target="#EditKamar<?= $kamar['kode_kamar'] ?>">
                <i class="fas fa-edit fa-fw"></i>
                Edit
              </button>
              <button class="dropdown-item" data-toggle="modal" data-target="#HapusKamar<?= $kamar['kode_kamar'] ?>">
                <i class="fas fa-trash fa-fw"></i>
                Hapus
              </button>
            </div>
          </td>
        </tr>

        <!-- MODAL EDIT -->
        <div class="modal fade" id="EditKamar<?= $kamar['kode_kamar'] ?>" tabindex="-1" role="dialog" aria-labelledby="EditKamarLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="EditKamarLabel">Edit Kamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="../../models/updates/u_kamar.php" method="POST">
                <div class="modal-body grey lighten-4 lighten-5 px-5">
                  <div class="form-group">
                    <label for="kode_kamar">Kode kamar</label>
                    <input type="text" class="form-control" id="kode_kamar" name="kode_kamar" autocomplete="off" readonly value="<?= $kamar['kode_kamar'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="kamar">Tipe Kamar</label>
                    <select class="form-control browser-default" id="kamar" name="kamar">
                      <option selected disabled>Pilih Unit kamar</option>
                      <option <?php if ($kamar['kamar'] == 'VIP') echo 'selected' ?>>VIP</option>
                      <option <?php if ($kamar['kamar'] == 'Reguler') echo 'selected' ?>>Reguler</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="harga_kamar">Harga Kamar</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                      </div>
                      <input type="number" class="form-control" id="harga_kamar" name="harga_kamar" autocomplete="off" value="<?= $kamar['harga_kamar'] ?>">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn shadow-none btn-outline-primary" data-dismiss="modal">Keluar</button>
                  <button type="submit" class="btn shadow-none btn-primary">Edit Kamar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /MODAL EDIT -->

        <!-- MODAL HAPUS -->
        <div class="modal fade" id="HapusKamar<?= $kamar['kode_kamar'] ?>" tabindex="-1" role="dialog" aria-labelledby="HapusKamarLabel" aria-hidden="true">
          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">

              <div class="modal-header">
                <h6 class="modal-title" id="HapusKamarLabel">Hapus Kamar</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <form action="../../models/deletes/d_kamar.php" method="POST">
                <div class="modal-body">

                  <div class="py-3 text-center">
                    <i class="fa fa-trash fa-fw fa-3x" aria-hidden="true"></i>
                    <h4 class="heading mt-4">Apakah Anda yakin akan menghapus?</h4>
                    <p>
                      Data kamar <u><?= $kamar['kode_kamar']; ?></u> [<?= $kamar['kamar']; ?>] seharga Rp. <?= $kamar['harga_kamar']; ?>,-
                    </p>
                  </div>

                </div>

                <div class="modal-footer">
                  <input type="hidden" name="kode_kamar" value="<?= $kamar['kode_kamar'] ?>">
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
<div class="modal fade" id="TambahKamar" tabindex="-1" role="dialog" aria-labelledby="TambahKamarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahKamarLabel">Tambah Kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../models/saves/s_kamar.php" method="POST">
        <div class="modal-body grey lighten-4 lighten-5 px-5">
          <div class="form-group">

            <?php
            $query_autonumber = mysqli_query($db, "SELECT * FROM kamar ORDER BY kode_kamar DESC LIMIT 1");

            if (mysqli_num_rows($query_autonumber) > 0) {
              $latestKD = mysqli_fetch_assoc($query_autonumber);
              $kode_kamar = autonumber($latestKD['kode_kamar'], 4, 3);
            } else {
              $kode_kamar = 'KMR-001';
            }

            ?>

            <label for="kode_kamar">Kode Kamar</label>
            <input type="text" class="form-control" id="kode_kamar" name="kode_kamar" autocomplete="off" value="<?= $kode_kamar ?>" readonly>
          </div>
          <div class="form-group">
            <label for="kamar">Tipe Kamar</label>
            <select class="form-control browser-default" id="kamar" name="kamar">
              <option selected disabled>Pilih Tipe kamar</option>
              <option>VIP</option>
              <option>Reguler</option>
            </select>
          </div>
          <div class="form-group">
            <label for="harga_kamar">Harga Kamar</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="number" class="form-control" id="harga_kamar" name="harga_kamar" autocomplete="off" auto>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn shadow-none btn-outline-primary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn shadow-none btn-primary">Simpan Kamar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /MODAL TAMBAH -->

<?php include '../templates/footer.php' ?>