<script>
  function SimpanJawaban() {
    var Jawaban1      = $("input[name='Jawaban_1']:checked").val();
    var Penjelasan_1  = $("#Penjelasan_1").val().trim();
    var Jawaban2      = $("input[name='Jawaban_2']:checked").val();
    var Penjelasan_2  = $("#Penjelasan_2").val().trim();
    var Jawaban3      = $("input[name='Jawaban_3']:checked").val();
    var Penjelasan_3  = $("#Penjelasan_3").val().trim();
    var Jawaban4      = $("input[name='Jawaban_4']:checked").val();
    var Penjelasan_4  = $("#Penjelasan_4").val().trim();
    var Jawaban5      = $("input[name='Jawaban_5']:checked").val();
    var Penjelasan_5  = $("#Penjelasan_5").val().trim();
    var Jawaban6      = $("input[name='Jawaban_6']:checked").val();
    var Penjelasan_6  = $("#Penjelasan_6").val().trim();
    var Jawaban7      = $("input[name='Jawaban_7']:checked").val();
    var Penjelasan_6  = $("#Penjelasan_6").val().trim();
    var Jawaban8      = $("input[name='Jawaban_8']:checked").val();
    var Penjelasan_8  = $("#Penjelasan_8").val().trim();
    
    if (!Jawaban1){
      alert('Jawaban pertanyaan No. 1 belum dijawab');
      $("#Jawaban_1").focus();
      //alert("Your are a - " + radioValue);
    } else if (Penjelasan_1 == "") {
      alert('Penjelasan No. 1 belum dijawab');
      $("#Penjelasan_1").focus();
    } else if (!Jawaban2) {
      alert('Jawaban pertanyaan No. 2 belum dijawab');
      $("#Jawaban_2").focus();
    } else if (Penjelasan_2 == "") {
      alert('Penjelasan No. 2 belum dijawab');
      $("#Penjelasan_2").focus();
    } else if (!Jawaban3) {
      alert('Jawaban pertanyaan No. 3 belum dijawab');
      $("#Jawaban_3").focus();
    } else if (Penjelasan_3 == "") {
      alert('Penjelasan No. 3 belum dijawab');
      $("#Penjelasan_3").focus();
    } else if (!Jawaban4) {
      alert('Jawaban pertanyaan No. 4 belum dijawab');
      $("#Jawaban_4").focus();
    } else if (Penjelasan_4 == "") {
      alert('Penjelasan No. 4 belum dijawab');
      $("#Penjelasan_4").focus();
    } else if (!Jawaban5) {
      alert('Jawaban pertanyaan No. 5 belum dijawab');
      $("#Jawaban_5").focus();
    } else if (Penjelasan_5 == "") {
      alert('Penjelasan No. 5 belum dijawab');
      $("#Penjelasan_5").focus();
    } else if (!Jawaban6) {
      alert('Jawaban pertanyaan No. 6 belum dijawab');
      $("#Jawaban_6").focus();
    } else if (Penjelasan_6 == "") {
      alert('Penjelasan No. 6 belum dijawab');
      $("#Penjelasan_6").focus();
    } else if (!Jawaban7) {
      alert('Jawaban pertanyaan No. 7 belum dijawab');
      $("#Jawaban_7").focus();
    } else if (Penjelasan_7 == "") {
      alert('Penjelasan No. 7 belum dijawab');
      $("#Penjelasan_7").focus();
    } else if (!Jawaban8) {
      alert('Jawaban pertanyaan No. 8 belum dijawab');
      $("#Jawaban_8").focus();
    } else if (Penjelasan_8 == "") {
      alert('Penjelasan No. 8 belum dijawab');
      $("#Penjelasan_8").focus();
    } else {
      var formData = $('#FormPertanyaan').serializeArray();
      formData.push({ name: "_token", value: "{{ csrf_token() }}" });
      $.ajax({
        data: formData,
        url: "{{ route('pertanyaan.dijawab') }}",
        type: "POST",
        dataType: "JSON",
        beforeSend: function (data) {
          $("#loading").show();
        },
        success: function(data) {
          ShowPertanyaan();
          showToast('success', data.message);
          $("#loading").hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          Swal.fire(
            'Oops...',
            jqXHR.responseJSON.message,
            textStatus
          );
          $("#loading").hide();
        }
      });
    }
  }

  function ShowPertanyaan() {
    $.ajax({
      data: {
        "_token": "{{ csrf_token() }}"
      },
      url: "{{ route('pertanyaan.listing') }}",
      type: "POST",
      dataType: "JSON",
      beforeSend: function (params) {
        $("#loading").show();
      },
      success: function(data) {
        $("#body-tiga").html(data.html);
        $("#loading").hide();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        Swal.fire(
          'Oops...',
          jqXHR.responseJSON.message,
          textStatus
        );
        $("#loading").hide();
      }
    });
  }

  $(document).ready(function () {
    $("#v-pills-confir-tab").click(function() {
      ShowPertanyaan();
    });
  });
</script>