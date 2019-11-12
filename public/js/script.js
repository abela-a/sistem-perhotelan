$(document).ready(function() {
  $("#datatables").DataTable();

  // $(".alert")
  //   .fadeTo(2000, 500)
  //   .slideUp(500, function() {
  //     $(this).slideUp(500);
  //   });
  $(".tombol-check-in").on("click", function() {
    console.log("Tombol");
    $(".checkin").on("show.bs.modal", function() {
      console.log("Modal");
      $("#kamar", this).change(function() {
        var harga = $("option:selected", this).attr("harga");
        $("#harga_kamar", ".checkin").val(harga);
        console.log("Harga Kamar = " + harga);
      });
    });
  });
});
