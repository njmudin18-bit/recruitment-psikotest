<!-- Modal Tambahan Satu -->
<div class="modal fade" id="modalTambahanSatu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="TambahanSatuForm">
          <input type="hidden" name="kodeTambahanSatu" id="kodeTambahanSatu">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Waktu:</label>
                <input type="date" name="WaktuTambahanSatu" id="WaktuTambahanSatu" class="form-control" placeholder="Contoh: John Doe">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Keterangan:</label>
                <textarea name="KeteranganTambahanSatu" id="KeteranganTambahanSatu" class="form-control"></textarea>
                <span class="help-block"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="btnSaveTambahanSatu" onclick="saveTambahanSatu()" type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<script>
  var save_method;
  var url;

  function openModalTambahanSatu() {
    save_method = 'add';
    $("#pass_div").show();
    $('#btnSaveTambahanSatu').text('Save');
    $('#TambahanSatuForm')[0].reset();
    $('.row').find(".has-error").removeClass("has-error");
    $('.help-block').empty();
    $('#modalTambahanSatu').modal('show');
    $('.modal-title').text('Tambah Catatan 1');
    $('#KeteranganTambahanSatu').summernote('reset');
  }

  function resetTambahanSatu() {
    $('#TambahanSatuForm')[0].reset();
    $('.modal-title').text('Tambah Catatan 1');
    $('#KeteranganTambahanSatu').summernote('reset');
  };

  function editTambahanSatu(id) {
    save_method = 'update';
    $('#TambahanSatuForm')[0].reset();
    $('.row').find(".has-error").removeClass("has-error");
    $('.help-block').empty();

    $.ajax({
      data: {
        "id": id,
        "_token": "{{ csrf_token() }}"
      },
      url: "{{ route('tambahan.edit') }}",
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        $('[name="kodeTambahanSatu"]').val(data.data.Id);
        $('[name="WaktuTambahanSatu"]').val(data.data.Waktu);
        $('#KeteranganTambahanSatu').summernote('code', data.data.Keterangan);

        $('#modalTambahanSatu').modal('show');
        $('.modal-title').text('Edit Catatan 1');
        $('#btnSaveTambahanSatu').text('Update');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        Swal.fire(
          'Oops...',
          jqXHR.responseJSON.message,
          textStatus
        );
      }
    });
  }

  function hapusTambahanSatu(id) {
    Swal.fire({
      title: "Anda yakin?",
      text: "Data yang dihapus tidak bisa dikembalikan!",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, hapus",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          data: {
            "id": id,
            "_token": "{{ csrf_token() }}"
          },
          url: "{{ route('tambahan.hapus') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            reload_table_tambahan_satu();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire(
              'Oops...',
              jqXHR.responseJSON.message,
              textStatus
            );
          }
        });
      }
    });
  }

  function reload_table_tambahan_satu() {
    tableTambahanSatu.ajax.reload(null,false);
  };

  function saveTambahanSatu(e) {
    if ($('#KeteranganTambahanSatu').summernote('isEmpty')) {
      alert("Keterangan satu tidak boleh kosong");
      $('#KeteranganTambahanSatu').summernote({
        focus: true
      });
    } else {
      var url;
      if(save_method == 'add') {
        url = "{{ route('tambahan.save') }}";
      } else {
        url = "{{ route('tambahan.update') }}";
      }

      var formData = $('#TambahanSatuForm').serializeArray();
      formData.push({ name: "_token", value: "{{ csrf_token() }}" });
      $.ajax({
        url : url,
        type: "POST",
        data: formData,
        dataType: "JSON",
        beforeSend: function (params) {
          $("#loading").show();
        },
        success: function(data)
        {
          showToast('success', data.message);
          reload_table_tambahan_satu();
          $("#loading").hide();
          $('#modalTambahanSatu').modal('hide');
          $('#btnSaveTambahanSatu').text('Save');
          $('#btnSaveTambahanSatu').attr('disabled',false);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          let data = jqXHR.responseJSON;
          if (data.status_code == 500) {
            for (var i = 0; i < data.inputerror.length; i++) 
            {
              $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error');
              $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
            }
          } else {
            Swal.fire({
              title: capitalizeFirstLetter(textStatus),
              text: data.message,
              icon: "error"
            });
          }
          $("#loading").hide();
          $('#btnSaveTambahanSatu').text('Save');
          $('#btnSaveTambahanSatu').attr('disabled',false);
        }
      });
    }
  }

  $(document).ready(function () {
    $("#loading").hide();

    $("#v-pills-shipping").click(function() {
      //tableTambahanDua.destroy();
      //alert('aaaa');
    });

    $('#KeteranganTambahanSatu').summernote({
      height: 300,
      toolbar: [
        [ 'style', [ 'style' ] ],
        [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
        [ 'fontname', [ 'fontname' ] ],
        [ 'fontsize', [ 'fontsize' ] ],
        [ 'color', [ 'color' ] ],
        [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
        [ 'table', [ 'table' ] ],
        [ 'insert', [ 'link'] ],
        [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
      ]
    });

    tableTambahanSatu = $('#datatable-tambahan-satu').DataTable({ 
      pagingType: "full_numbers",
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      responsive: false,
      processing: true,
      serverSide: true,
      order: [[1, 'desc']], //[2, 'desc']
      ajax: {
        "url": "{{ route('tambahan.index') }}",
        "type": "GET",
      },
      columns: [
        {
          data: 'DT_RowIndex', 
          name: 'DT_RowIndex',
          orderable: false, 
          searchable: false,
          className: 'text-end'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          className: 'text-center'
        },
        {
          data: 'Waktu',
          name: 'Waktu',
          className: 'text-center'
        },
        {
          data: 'Keterangan',
          name: 'Keterangan',
          className: 'text-start'
        },
        {
          data: 'CreatedDate',
          name: 'CreatedDate',
          className: 'text-center'
        }
      ]
    });

    $("#KeteranganTambahanSatu").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#WaktuTambahanSatu").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });
  });
</script>