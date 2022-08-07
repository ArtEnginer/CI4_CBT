const modalDiv = document.getElementById("myModal");
let myModal = "";
let modalTitle = "";
let modalBody = "";
if (modalDiv) {
  myModal = new bootstrap.Modal("#myModal");
  modalTitle = modalDiv.querySelector(".modal-title");
  modalBody = modalDiv.querySelector(".modal-body");
}
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
  $("body").on("click", ".essay-img", function (event) {
    let id = $(this).data("id");
    let nomor = $(this).data("nomor");
    $.get(`/ujian/soal/essay/${id}/${nomor}/img`, function (data) {
      modalTitle.textContent = `Upload Gambar`;
      $(".modal-body").html(data);
      Dropzone.discover();
      myModal.toggle();
    });
  });
  $("body").on("click", ".ujian-nomor", function (event) {
    let tipe = $(this).data("tipe");
    let token = $(this).data("token");
    let nomor = $(this).data("nomor");
    $.get(`/ujian/get/${token}/${tipe}/${nomor}`, function (data) {
      $(".soal-body").html(data.html);
      if (tipe == "essay") {
        $("#summernote").summernote();
      }
      if (data.last) {
        $(".btn-next").removeClass("app-btn-primary app-btn-secondary ujian-done ujian-next");
        $(".btn-next").addClass("app-btn-primary ujian-done");
        $(".btn-next").text("Selesai");
        $(".btn-next").val("done");
      } else {
        $(".btn-next").removeClass("app-btn-primary app-btn-secondary ujian-done ujian-next");
        $(".btn-next").addClass("app-btn-secondary ujian-next");
        $(".btn-next").text("Selanjutnya");
        $(".btn-next").val("next");
      }
    });
  });
  $("#summernote").summernote();
});
