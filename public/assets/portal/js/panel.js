const myModal = new bootstrap.Modal("#myModal");
const modalDiv = document.getElementById("myModal");
const modalTitle = modalDiv.querySelector(".modal-title");
const modalBody = modalDiv.querySelector(".modal-body");
$(document).ready(function () {
  $(".datatables-init").DataTable();
  if (document.getElementById("datetimepicker")) {
    new tempusDominus.TempusDominus(document.getElementById("datetimepicker"));
  }
  $("body").on("click", ".pilgan-img", function (event) {
    let id = $(this).data("id");
    let nomor = $(this).data("nomor");
    $.get(`/ujian/soal/pilgan/${id}/${nomor}/img`, function (data) {
      modalTitle.textContent = `Upload Gambar`;
      $(".modal-body").html(data);
      Dropzone.discover();
      myModal.toggle();
    });
  });
});
