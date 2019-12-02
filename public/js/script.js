$(document).ready(function() {
  //DATA TABLES
  $("#datatables").DataTable();
  $("select[name='datatables_lenght']").addClass("d-inline");

  //INPUT GAMBAR FIX LABEL
  $(".custom-file-input").on("change", function() {
    let filename = $(this)
      .val()
      .split("\\")
      .pop();
    $(this)
      .next(".custom-file-label")
      .addClass("selected")
      .html(filename);
  });
});
