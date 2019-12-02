<?php
include '../app/views/templates/header.php';
$judul = 'Data Tamu';
include '../app/views/templates/navadmin.php';

// QUERY TAMU
$query_tamu = mysqli_query($db, "SELECT * FROM tamu ORDER BY id_tamu DESC");
// QUERY KAMAR KOSONG
$query_kamarkosong = mysqli_query($db, "SELECT * FROM kamar WHERE status_kamar = 'Kosong'");
// QUERY JASA
$query_jasa = mysqli_query($db, "SELECT * FROM jasa");
// NOMOR URUT UNTUK TABEL
$no = 1;
?>
<div class="container mt-4 py-3 px-5 bg-white rounded shadow-sm border border-istimewa">
  <div class="clearfix">
    <h1 class="display-5 font-weight-bold text-primary float-left mt-1">
      <?= strtoupper($judul); ?>
    </h1>
    <button class="btn shadow-none btn-primary float-right" id="TombolTambahTamu" data-toggle="modal" data-target="#TambahTamu">
      <i class="fas fa-users fa-fw"></i>
      Tambah Tamu
    </button>
  </div>
</div>
<div class="container mt-4 bg-white rounded p-5 shadow-sm">

  <?php Alert(); ?>

  <table class="table align-items-center table-bordered mt-4" id="">
    <thead class="thead-light">
      <th scope="col" class="text-center">#</th>
      <th scope="col" class="text-center">ID Tamu</th>
      <th scope="col" class="text-center">Nama</th>
      <th scope="col" class="text-center">Tanggal Check In</th>
      <th scope="col" class="text-center">Tanggal Check Out</th>
      <th scope="col" class="text-center">Telepon</th>
      <th scope="col" class="text-center" style="width:80px">Status</th>
      <th scope="col" class="text-center" style="width:10px"><i class="fa fa-bars" aria-hidden="true"></i></th>
    </thead>
    <tbody>
      <?php while ($tamu = mysqli_fetch_array($query_tamu)) : ?>
        <tr>
          <td class="align-middle"><?= $no++; ?></td>
          <td class="align-middle"><?= $tamu['id_tamu']; ?></td>
          <td class="align-middle"><?= $tamu['nama']; ?></td>
          <td class="align-middle"><?= $tamu['tanggal_check_in']; ?></td>
          <td class="align-middle"><?= $tamu['tanggal_check_out']; ?></td>
          <td class="align-middle"><?= $tamu['telepon']; ?></td>
          <td class="align-middle text-center">
            <?php if ($tamu['status_tamu'] == 'Check Out') : ?>
              <h5><span class="badge badge-danger shadow-none"><?= $tamu['status_tamu'] ?></span></h5>
            <?php else : ?>
              <h5><span class="badge badge-success shadow-none"><?= $tamu['status_tamu'] ?></span></h5>
            <?php endif; ?>
          </td>
          <td class="align-middle">
            <button type="button" class="dropdown btn shadow-none btn-sm btn-icon-only" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-fw" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu dropdown-primary dropdown-menu-right mt-2">
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
              <form action="../app/models/TamuModel.php" method="POST">
                <div class="modal-body grey lighten-4 lighten-5 px-5">
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
                    <select class="form-control browser-default" id="pekerjaan" name="pekerjaan">
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
                  <button type="button" class="btn shadow-none btn-outline-primary" data-dismiss="modal">Keluar</button>
                  <button type="submit" class="btn shadow-none btn-primary" name="update">Edit Tamu</button>
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
              <form action="../app/models/TamuModel.php" method="POST">
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
                  <button type="submit" class="btn shadow-none btn-white" name="delete">Ok, Hapus</button>
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
<div class="modal fade" id="TambahTamu" tabindex="-1" role="dialog" aria-labelledby="TambahTamuLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahTamuLabel">Tambah Tamu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../app/models/TamuModel.php" method="POST">
        <div class="modal-body grey lighten-4 lighten-5 px-5">
          <div class="form-group">

            <?php
            $query_autonumber = mysqli_query($db, "SELECT * FROM tamu ORDER BY id_tamu DESC LIMIT 1");

            if (mysqli_num_rows($query_autonumber) > 0) {
              $latestKD = mysqli_fetch_assoc($query_autonumber);
              $id_tamu = autonumber($latestKD['id_tamu'], 3, 5);
            } else {
              $id_tamu = 'TM-00001';
            }

            ?>

            <label for="id_tamu">ID Tamu</label>
            <input type="text" class="form-control" id="id_tamu" name="id_tamu" autocomplete="off" value="<?= $id_tamu ?>" readonly>
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
            <select class="form-control browser-default" id="pekerjaan" name="pekerjaan">
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
          <div class="form-group">
            <label for="kamar">Kamar</label>
            <select class="form-control browser-default" id="kamar" name="kamar">
              <option selected disabled>Pilih Kamar</option>
              <?php while ($kamarkosong = mysqli_fetch_array($query_kamarkosong)) : ?>
                <option harga="<?= $kamarkosong['harga_kamar'] ?>" value="<?= $kamarkosong['kode_kamar'] ?>">
                  <?= $kamarkosong['kode_kamar'] ?> | <?= $kamarkosong['kamar'] ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="harga_kamar">Harga Kamar</label>
            <input type="text" readonly class="form-control" id="harga_kamar" name="harga_kamar" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="jasa">Jasa</label>
            <select class="form-control browser-default" id="jasa" name="jasa">
              <option selected disabled>Pilih Jasa</option>
              <?php while ($jasa = mysqli_fetch_array($query_jasa)) : ?>
                <option harga="<?= $jasa['harga_jasa'] ?>" value="<?= $jasa['kode_jasa'] ?>">
                  <?= $jasa['kode_jasa'] ?> | <?= $jasa['jasa'] ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="harga_jasa">Harga Jasa</label>
            <input type="text" readonly class="form-control" id="harga_jasa" name="harga_jasa" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="tanggal_check_in">Tanggal Check In</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><span class="fas fa-calendar-alt"></span></span>
              </div>
              <input type="date" class="form-control datepicker" id="tanggal_check_in" name="tanggal_check_in" autocomplete="off">
            </div>
          </div>

          <div class="form-group">
            <label for="tanggal_check_out">Tanggal Check Out</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><span class="fas fa-calendar-alt"></span></span>
              </div>
              <input type="date" class="form-control datepicker" id="tanggal_check_out" name="tanggal_check_out" autocomplete="off">
            </div>
          </div>

          <div class="form-group">
          </div>

          <div class="form-group">
            <label for="hari">Lama Menginap</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="hari" name="hari" autocomplete="off" readonly>
              <div class="input-group-prepend">
                <span class="input-group-text">Hari</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn shadow-none btn-outline-primary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn shadow-none btn-primary" name="save">Simpan Tamu</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /MODAL TAMBAH -->

<?php include '../app/views/templates/footer.php' ?>