$(document).ready(function() {
  // HARGA KAMAR DAN JASA
  $("#TombolTambahTamu").on("click", function() {
    $("#TambahTamu").on("show.bs.modal", function() {
      // KAMAR
      $("#kamar", this).change(function() {
        var harga_kamar = $("option:selected", this).attr("harga");
        $("#harga_kamar").val(harga_kamar);
      });
      // JASA
      $("#jasa", this).change(function() {
        var harga_jasa = $("option:selected", this).attr("harga");
        $("#harga_jasa").val(harga_jasa);
      });
    });
  });
  // LAMA NGINAP
  $('input[name="tanggal_check_out"]').change(function() {
    var start = $('input[name="tanggal_check_in_submit"]').val();
    var end = $('input[name="tanggal_check_out_submit"]').val();

    var start = moment(start);
    var end = moment(end);

    var hari = end.diff(start, "days");
    $('input[name="hari"]').val(hari);
  });
});
