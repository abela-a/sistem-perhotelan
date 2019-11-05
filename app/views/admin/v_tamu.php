<?php
include '../templates/header.php';
$judul = 'Data Tamu';
include '../templates/navadmin.php';

// QUERY TAMU
$query_tamu = mysqli_query($db, "SELECT * FROM tamu ORDER BY id_tamu DESC");
// NOMOR URUT UNTUK TABEL
$no = 1;
?>
<div class="container mt-4 py-3 px-5 bg-white rounded shadow-sm border border-warning">
  <div class="clearfix">
    <h1 class="display-2 text-warning float-left">
      <?= $judul; ?>
    </h1>
    <button class="btn btn-primary float-right mt-3" data-toggle="modal" data-target="#TambahTamu">
      <i class="fas fa-users fa-fw"></i>
      Tambah Tamu
    </button>
  </div>
</div>
<div class="container mt-4 bg-white rounded p-5 shadow-sm">

  <?php Alert(); ?>

  <table class="table align-items-center table-flush mt-4" id="datatables">
    <thead class="thead-light">
      <tr>
        <th scope="col">#</th>
        <th scope="col">ID Tamu</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">Pekerjaan</th>
        <th scope="col">Telepon</th>
        <th scope="col">Pilihan</th>
        <th scope="col" style="width:10px"><i class="fa fa-bars" aria-hidden="true"></i></th>
      </tr>
    </thead>
    <tbody>
      <?php while ($tamu = mysqli_fetch_array($query_tamu)) : ?>
        <tr>
          <td class="align-middle"><?= $no++; ?></td>
          <td class="align-middle"><?= $tamu['id_tamu']; ?></td>
          <td class="align-middle"><?= $tamu['nama']; ?></td>
          <td class="align-middle"><?= $tamu['alamat']; ?></td>
          <td class="align-middle"><?= $tamu['pekerjaan']; ?></td>
          <td class="align-middle"><?= $tamu['telepon']; ?></td>
          <td class="align-middle">
            <?php if ($tamu['status_tamu'] == '') : ?>
              <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#check-in<?= $tamu['id_tamu'] ?>">Check In</button>
            <?php elseif ($tamu['status_tamu'] == 'Check Out') : ?>
              <button class="btn btn-sm btn-secondary" disabled>Checked Out</button>
            <?php else : ?>
              <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#check-out<?= $tamu['id_tamu'] ?>">Check Out</button>
            <?php endif; ?>
          </td>
          <td class="align-middle">
            <button type="button" class="dropdown btn btn-sm btn-icon-only text-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-fw" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right mt-2">
              <button class="dropdown-item" data-toggle="modal" data-target="#EditTamu<?= $tamu['id_tamu'] ?>">
                <i class="fas fa-edit fa-fw"></i>
                Edit
              </button>
              <button class="dropdown-item" data-toggle="modal" data-target="#HapusTamu<?= $tamu['id_tamu'] ?>">
                <i class="fas fa-trash fa-fw"></i>
                Hapus
              </button>
            </div>
          </td>
        </tr>

        <!-- MODAL EDIT -->
        <div class="modal fade" id="EditTamu<?= $tamu['id_tamu'] ?>" tabindex="-1" role="dialog" aria-labelledby="EditTamuLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="EditTamuLabel">Edit Tamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="../../models/updates/u_tamu.php" method="POST">
                <div class="modal-body bg-secondary px-5">
                  <div class="form-group">
                    <label for="id_tamu">ID Tamu</label>
                    <input type="text" class="form-control" id="id_tamu" name="id_tamu" autocomplete="off" readonly value="<?= $tamu['id_tamu'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" value="<?= $tamu['nama'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat"><?= $tamu['alamat'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <select class="form-control" id="pekerjaan" name="pekerjaan">
                      <option selected disabled>Pilih Pekerjaan</option>
                      <option <?php if ($tamu['pekerjaan'] == 'Mahasiswa') echo 'selected' ?>>Mahasiswa</option>
                      <option <?php if ($tamu['pekerjaan'] == 'Karyawan Swasta') echo 'selected' ?>>Karyawan Swasta</option>
                      <option <?php if ($tamu['pekerjaan'] == 'PNS') echo 'selected' ?>>PNS</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" autocomplete="off" value="<?= $tamu['telepon'] ?>">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                  <button type="submit" class="btn btn-primary">Edit Tamu</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /MODAL EDIT -->

        <!-- MODAL HAPUS -->
        <div class="modal fade" id="HapusTamu<?= $tamu['id_tamu'] ?>" tabindex="-1" role="dialog" aria-labelledby="HapusTamuLabel" aria-hidden="true">
          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">

              <div class="modal-header">
                <h6 class="modal-title" id="HapusTamuLabel">Hapus Tamu</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <form action="../../models/deletes/d_tamu.php" method="POST">
                <div class="modal-body">

                  <div class="py-3 text-center">
                    <i class="fa fa-trash fa-fw fa-3x" aria-hidden="true"></i>
                    <h4 class="heading mt-4">Apakah Anda yakin akan menghapus?</h4>
                    <p>
                      Tamu [<?= $tamu['id_tamu']; ?>] <u><?= $tamu['nama']; ?></u>
                    </p>
                  </div>

                </div>

                <div class="modal-footer">
                  <input type="hidden" name="id_tamu" value="<?= $tamu['id_tamu'] ?>">
                  <button type="submit" class="btn btn-white">Ok, Hapus</button>
                  <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
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
<div class="modal fade" id="TambahTamu" tabindex="-1" role="dialog" aria-labelledby="TambahTamuLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahTamuLabel">Tambah Tamu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../../models/saves/s_tamu.php" method="POST">
        <div class="modal-body bg-secondary px-5">
          <div class="form-group">
            <label for="id_tamu">ID Tamu</label>
            <input type="text" class="form-control" id="id_tamu" name="id_tamu" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat"></textarea>
          </div>
          <div class="form-group">
            <label for="pekerjaan">Pekerjaan</label>
            <select class="form-control" id="pekerjaan" name="pekerjaan">
              <option selected disabled>Pilih Pekerjaan</option>
              <option>Mahasiswa</option>
              <option>Karyawan Swasta</option>
              <option>PNS</option>
            </select>
          </div>
          <div class="form-group">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" autocomplete="off">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Simpan Tamu</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /MODAL TAMBAH -->

<?php include '../templates/footer.php' ?>