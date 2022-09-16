const modalDiv = document.getElementById("myModal");
let myModal = "";
let modalTitle = "";
let modalBody = "";
if (modalDiv) {
  myModal = new bootstrap.Modal("#myModal");
  modalTitle = modalDiv.querySelector(".modal-title");
  modalBody = modalDiv.querySelector(".modal-body");
}
$body = $("body");

$(document).on({
  ajaxStart: function () {
    $body.addClass("loading");
  },
  ajaxStop: function () {
    $body.removeClass("loading");
  },
});
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
    let tipejawab = $('[name="tipe"]').val();
    let jawaban = "";
    if (tipejawab == "pilgan") {
      jawaban = $('[name="jawaban"]:checked').val();
    } else {
      jawaban = $('[name="jawaban"]').val();
    }
    let url = $("form").first().prop("action");
    let tipe = $(this).data("tipe");
    let token = $(this).data("token");
    let nomor = $(this).data("nomor");
    if (jawaban) {
      $.ajax({
        type: "POST",
        url: url,
        data: { tipe: tipe, jawaban: decodeURIComponent(jawaban) },
        success: function (data) {
          // console.log(data);
        },
      });
    }
    $.get(`/ujian/get/${token}/${tipe}/${nomor}`, function (data) {
      $(".soal-body").html(data.html);
      if (tipe == "essay") {
        $("#summernote").summernote();
      }
      if (data.last) {
        $(".btn-next").removeClass(
          "app-btn-primary app-btn-secondary ujian-done ujian-next"
        );
        $(".btn-next").addClass("app-btn-primary ujian-done");
        $(".btn-next").text("Selesai");
        $(".btn-next").val("done");
      } else {
        $(".btn-next").removeClass(
          "app-btn-primary app-btn-secondary ujian-done ujian-next"
        );
        $(".btn-next").addClass("app-btn-secondary ujian-next");
        $(".btn-next").text("Selanjutnya");
        $(".btn-next").val("next");
      }
      $(".ujian-nomor").removeClass("active");
      $(`.ujian-nomor.${data.tipe}-${data.nomor}`).addClass("active");
      console.log(data);
    });
  });
  $("body").on("click", ".ujian-prev", function (event) {
    let tipe = $('[name="tipe"]').val();
    let jawaban = "";
    if (tipe == "pilgan") {
      jawaban = $('[name="jawaban"]:checked').val();
    } else {
      jawaban = $('[name="jawaban"]').val();
    }
    let url = $("form").first().prop("action");
    let token = $(this).data("token");
    if (jawaban) {
      $.ajax({
        type: "POST",
        url: url,
        data: { tipe: tipe, jawaban: decodeURIComponent(jawaban) },
        success: function (data) {
          // console.log(data);
        },
      });
    }
    $.get(`/ujian/get/${token}/now/prev`, function (data) {
      $(".soal-body").html(data.html);
      if (data.tipe == "essay") {
        $("#summernote").summernote();
      }
      if (data.last) {
        $(".btn-next").removeClass(
          "app-btn-primary app-btn-secondary ujian-done ujian-next"
        );
        $(".btn-next").addClass("app-btn-primary ujian-done");
        $(".btn-next").text("Selesai");
        $(".btn-next").val("done");
      } else {
        $(".btn-next").removeClass(
          "app-btn-primary app-btn-secondary ujian-done ujian-next"
        );
        $(".btn-next").addClass("app-btn-secondary ujian-next");
        $(".btn-next").text("Selanjutnya");
        $(".btn-next").val("next");
      }
      $(".ujian-nomor").removeClass("active");
      $(`.ujian-nomor.${data.tipe}-${data.nomor}`).addClass("active");
      console.log(data);
    });
  });
  $("body").on("click", ".ujian-next", function (event) {
    let tipe = $('[name="tipe"]').val();
    let jawaban = "";
    if (tipe == "pilgan") {
      jawaban = $('[name="jawaban"]:checked').val();
    } else {
      jawaban = $('[name="jawaban"]').val();
    }
    let url = $("form").first().prop("action");
    let token = $(this).data("token");
    if (jawaban) {
      $.ajax({
        type: "POST",
        url: url,
        data: { tipe: tipe, jawaban: decodeURIComponent(jawaban) },
        success: function (data) {
          // console.log(data);
        },
      });
    }
    $.get(`/ujian/get/${token}/now/next`, function (data) {
      $(".soal-body").html(data.html);
      if (data.tipe == "essay") {
        $("#summernote").summernote();
      }
      if (data.last) {
        $(".btn-next").removeClass(
          "app-btn-primary app-btn-secondary ujian-done ujian-next"
        );
        $(".btn-next").addClass("app-btn-primary ujian-done");
        $(".btn-next").text("Selesai");
        $(".btn-next").val("done");
      } else {
        $(".btn-next").removeClass(
          "app-btn-primary app-btn-secondary ujian-done ujian-next"
        );
        $(".btn-next").addClass("app-btn-secondary ujian-next");
        $(".btn-next").text("Selanjutnya");
        $(".btn-next").val("next");
      }
      $(".ujian-nomor").removeClass("active");
      $(`.ujian-nomor.${data.tipe}-${data.nomor}`).addClass("active");
      console.log(data);
    });
  });
  $("body").on("click", ".ujian-done", function (event) {
    let tipe = $('[name="tipe"]').val();
    let jawaban = "";
    if (tipe == "pilgan") {
      jawaban = $('[name="jawaban"]:checked').val();
    } else {
      jawaban = $('[name="jawaban"]').val();
    }
    let url = $("form").first().prop("action");
    let token = $(this).data("token");
    if (jawaban) {
      $.ajax({
        type: "POST",
        url: url,
        data: { tipe: tipe, jawaban: decodeURIComponent(jawaban) },
        success: function (data) {
          // console.log(data);
        },
      });
    }
    $(location).prop("href", `/ujian/room/${token}/done`);
  });
  if (dateline) {
    countdownTimeStart(dateline);
  }

   Dropzone.options.myGreatDropzone = {
     // camelized version of the `id`
     paramName: "file", // The name that will be used to transfer the file
     maxFilesize: 2, // MB
     maxFiles: 1,
     acceptedFiles: ".xlsx,.xls",
     uploadMultiple: false,
     dictDefaultMessage: "Drop files here to upload",
     dictFallbackMessage:
       "Your browser does not support drag'n'drop file uploads.",
     dictFallbackText:
       "Please use the fallback form below to upload your files like in the olden days.",
   };
});

function countdownTimeStart(tgl) {
  // var countDownDate = new Date("Sep 25, 2025 15:00:00").getTime();
  var countDownDate = new Date(tgl).getTime();

  // Update the count down every 1 second
  var x = setInterval(function () {
    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now an the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var hours = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML =
      hours + ":" + minutes + ":" + seconds;

    // If the count down is over, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "Waktu Habis";
    }
  }, 1000);
}
