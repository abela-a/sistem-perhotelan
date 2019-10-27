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
    <h1 class="display-2 text-warning float-left">
      <?= $judul; ?>
    </h1>
    <button class="btn btn-primary float-right mt-3" data-toggle="modal" data-target="#TambahJasa">
      <i class="fas fa-briefcase fa-fw"></i>
      Tambah Jasa
    </button>
  </div>

</div>
<div class="container mt-4 bg-white rounded p-5 shadow-sm">
  <table class="table align-items-center table-flush mt-4" id="datatables">
    <thead class="thead-light">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Kode Jasa</th>
        <th scope="col">Jasa</th>
        <th scope="col">Unit Jasa</th>
        <th scope="col">Harga Jasa</th>
        <th scope="col" style="width:15px"></th>
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
            <button type="button" class="dropdown btn btn-sm btn-icon-only text-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-fw" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right mt-2">
              <button class="dropdown-item" data-toggle="modal" data-target="">
                <i class="fas fa-edit fa-fw"></i>
                Edit
              </button>
              <button class="dropdown-item" data-toggle="modal" data-target="">
                <i class="fas fa-trash fa-fw"></i>
                Hapus
              </button>
            </div>
          </td>
        </tr>
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
        <div class="modal-body bg-secondary px-5">
          <div class="form-group">
            <label for="kode_jasa">Kode Jasa</label>
            <input type="text" class="form-control" id="kode_jasa" name="kode_jasa" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="jasa">Jasa</label>
            <input type="text" class="form-control" id="jasa" name="jasa" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="unit_jasa">Unit Jasa</label>
            <select class="form-control" id="unit_jasa" name="unit_jasa">
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Simpan Jasa</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /MODAL TAMBAH -->

<?php include '../templates/footer.php' ?>