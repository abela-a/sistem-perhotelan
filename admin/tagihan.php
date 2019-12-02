<?php
include '../app/views/templates/header.php';
$judul = 'Data Tagihan';
include '../app/views/templates/navadmin.php';

// QUERY TAGIHAN
$query_tagihan = mysqli_query($db, "SELECT * FROM view_tagihan");
// NOMOR URUT UNTUK TABEL
$no = 1;
?>
<div class="container mt-4 py-3 px-5 bg-white rounded shadow-sm border border-istimewa">
  <div class="clearfix">
    <h1 class="display-5 font-weight-bold text-primary float-left mt-1">
      <?= strtoupper($judul); ?>
    </h1>
    <button class="btn shadow-none btn-primary float-right" data-toggle="modal" data-target="#TambahTagihan">
      <i class="fas fa-dollar-sign fa-fw"></i>
      Tambah Tagihan
    </button>
  </div>
</div>
<div class="container mt-4 bg-white rounded p-5 shadow-sm mb-5">

  <?php Alert(); ?>

  <table class="table align-items-center table-bordered mt-4" id="">
    <thead class="thead-light">
      <th scope="col" class="text-center">#</th>
      <th scope="col" class="text-center">Kode</th>
      <th scope="col" class="text-center">Nama</th>
      <th scope="col" class="text-center">Kamar</th>
      <th scope="col" class="text-center">Jasa</th>
      <th scope="col" class="text-center">Total</th>
      <th scope="col" class="text-center"><i class="fa fa-bars fa-fw" aria-hidden="true"></i></th>
    </thead>
    <tbody>
      <?php while ($tagihan = mysqli_fetch_array($query_tagihan)) : ?>
        <tr>
          <td class="align-middle"><?= $no++; ?></td>
          <td class="align-middle"><?= $tagihan['kode_tagihan']; ?></td>
          <td class="align-middle">
            <?= $tagihan['nama']; ?>
            <span class="badge shadow-none badge-primary">
              <?= $tagihan['id_tamu']; ?>
            </span>
          </td>
          <td class="align-middle">
            <?= $tagihan['kamar']; ?>
            <span class="badge shadow-none badge-primary">
              <?= $tagihan['kode_kamar']; ?>
            </span>
          </td>
          <td class="align-middle">
            <?= $tagihan['jasa']; ?>
            <span class="badge shadow-none badge-primary">
              <?= $tagihan['kode_jasa']; ?>
            </span>
          </td>
          <td class="align-middle">Rp. <?= $tagihan['total_tagihan']; ?>,-</td>
          <td class="align-middle text-center">
            <button class="btn btn-danger btn-sm shadow-none" data-toggle="modal" data-target="#HapusTagihan<?= $tagihan['kode_tagihan'] ?>">
              <i class="fas fa-trash fa-fw"></i>
              Hapus
            </button>
          </td>
        </tr>

        <!-- MODAL HAPUS -->
        <div class="modal fade" id="HapusTagihan<?= $tagihan['kode_tagihan'] ?>" tabindex="-1" role="dialog" aria-labelledby="HapusTagihanLabel" aria-hidden="true">
          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">

              <div class="modal-header">
                <h6 class="modal-title" id="HapusTagihanLabel">Hapus Tagihan</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <form action="../app/models/TagihanModel.php" method="POST">
                <div class="modal-body">

                  <div class="py-3 text-center">
                    <i class="fa fa-trash fa-fw fa-3x" aria-hidden="true"></i>
                    <h4 class="heading mt-4">Apakah Anda yakin akan menghapus?</h4>
                    <p>
                      Data tagihan atas nama <?= $tagihan['nama']; ?> dengan kode <u><?= $tagihan['kode_tagihan']; ?></u> selama <u><?= $tagihan['hari']; ?> hari</u> senilai Rp. <?= $tagihan['total_tagihan']; ?>,-
                    </p>
                  </div>

                </div>

                <div class="modal-footer">
                  <input type="hidden" name="kode_tagihan" value="<?= $tagihan['kode_tagihan'] ?>">
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
<div class="modal fade" id="TambahTagihan" tabindex="-1" role="dialog" aria-labelledby="TambahTagihanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahTagihanLabel">Tambah Tagihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="../app/models/TagihanModel.php" method="POST">
        <div class="modal-body grey lighten-4 lighten-5 px-5">
          <div class="form-group">

            <?php
            $query_autonumber = mysqli_query($db, "SELECT * FROM tagihan ORDER BY kode_tagihan DESC LIMIT 1");

            if (mysqli_num_rows($query_autonumber) > 0) {
              $latestKD = mysqli_fetch_assoc($query_autonumber);
              $kode_tagihan = autonumber($latestKD['kode_tagihan'], 3, 5);
            } else {
              $kode_tagihan = 'TG-0000001';
            }

            ?>

            <label for="kode_tagihan">Kode Tagihan</label>
            <input type="text" class="form-control" id="kode_tagihan" name="kode_tagihan" autocomplete="off" readonly value="<?= $kode_tagihan ?>">
          </div>

          <div class="form-group">
            <label>Tamu</label>
            <select class="form-control browser-default tamu" name="id_tamu">
              <option selected disabled>Pilih Tamu</option>
              <?php
              $tamu = mysqli_query($db, "SELECT * FROM tamu WHERE status_tamu = 'Check In'");
              while ($t = mysqli_fetch_array($tamu)) {
                ?>
                <option value="<?= $t['id_tamu'] ?>"><?= $t['id_tamu'] ?> - <?= $t['nama'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="tagihan">

            <div class="form-group">
              <label>Kamar</label>
              <input type="text" class="form-control" readonly>
            </div>

            <div class="form-group">
              <label>Tarif Kamar Perhari</label>
              <input type="text" class="form-control kamar" readonly>
            </div>

            <div class="form-group">
              <label>Jasa</label>
              <input type="text" class="form-control" readonly>
            </div>

            <div class="form-group">
              <label>Tarif Jasa Perhari</label>
              <input type="text" class="form-control jasa" readonly>
            </div>

            <div class="form-group">
              <label>Tanggal Check In</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><span class="fas fa-calendar-alt"></span></span>
                </div>
                <input type="date" class="form-control" readonly>
              </div>
            </div>

            <div class="form-group">
              <label>Tanggal Check Out</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><span class="fas fa-calendar-alt"></span></span>
                </div>
                <input type="date" class="form-control" readonly>
              </div>
            </div>

            <div class="form-group">
              <label>Lama Menginap</label>
              <div class="input-group mb-3">
                <input type="number" readonly class="form-control hari">
                <div class="input-group-prepend">
                  <span class="input-group-text">Hari</span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Total Tagihan</label>
              <input type="text" name="total_tagihan" readonly class="form-control">
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-block shadow-none btn-success" name="save">Check Out</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /MODAL TAMBAH -->

<?php include '../app/views/templates/footer.php' ?>

<script>
  $(document).ready(function() {
    $('.tamu').change(function() {
      let id = $(this).val()
      console.log(id);
      $('.tagihan').load('../app/views/get/tambah_tagihan.php?id=' + id);
    });
  });
</script>