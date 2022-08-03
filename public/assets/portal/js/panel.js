$(document).ready(function () {
  $(".datatables-init").DataTable();
  if (document.getElementById("datetimepicker")) {
    new tempusDominus.TempusDominus(document.getElementById("datetimepicker"));
  }
});
