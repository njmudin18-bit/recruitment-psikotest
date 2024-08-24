<!-- Modal Kontak -->
<div class="modal fade" id="modalKontak" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="kontakForm">
          <input type="hidden" name="kodeKontak" id="kodeKontak">
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Nama:</label>
                <input type="text" name="NamaKontak" id="NamaKontak" class="form-control text-capitalize" placeholder="Contoh: John Doe">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Hubungan:</label>
                <input type="text" name="HubunganKontak" id="HubunganKontak" class="form-control text-capitalize" placeholder="Contoh: Suami atau Istri dll.">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">No handphone:</label>
                <input type="text" name="NoHpKontak" id="NoHpKontak" class="form-control" placeholder="Contoh: +62 8XX XXXX XXXX">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Alamat</label>
                <input type="text" name="AlamatKontak" id="AlamatKontak" class="form-control text-capitalize" placeholder="Contoh: Jl. Otista Nomor 2">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="btnSave" onclick="saveKontak()" type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<script>
  var save_method;
  var url;

  function openModalKontak() {
    save_method = 'add';
    $("#pass_div").show();
    $('#btnSave').text('Save');
    $('#kontakForm')[0].reset();
    $('.row').find(".has-error").removeClass("has-error");
    $('.help-block').empty();
    $('#modalKontak').modal('show');
    $('.modal-title').text('Tambah Kontak Darurat');
  }

  function resetKontak() {
    $('#kontakForm')[0].reset();
    $('.modal-title').text('Tambah Kontak Darurat');
  };

  function editKontak(id) {
    save_method = 'update';
    $('#kontakForm')[0].reset();
    $('.row').find(".has-error").removeClass("has-error");
    $('.help-block').empty();

    $.ajax({
      data: {
        "id": id,
        "_token": "{{ csrf_token() }}"
      },
      url: "{{ route('kontak.edit') }}",
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        $('[name="kodeKontak"]').val(data.data.Id);
        $('[name="NamaKontak"]').val(data.data.Nama);
        $('[name="HubunganKontak"]').val(data.data.Hubungan);
        $('[name="NoHpKontak"]').val(data.data.NoHp);
        $('[name="AlamatKontak"]').val(data.data.Alamat);

        $('#modalKontak').modal('show');
        $('.modal-title').text('Edit Kontak Darurat');
        $('#btnSave').text('Update');
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

  function hapusKontak(id) {
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
          url: "{{ route('kontak.hapus') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            reload_table_kontak();
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

  function reload_table_kontak() {
    tableKontak.ajax.reload(null,false);
  };

  function saveKontak(e) {
    var url;
    if(save_method == 'add') {
      url = "{{ route('kontak.save') }}";
    } else {
      url = "{{ route('kontak.update') }}";
    }

    var formData = $('#kontakForm').serializeArray();
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
        reload_table_kontak();
        $("#loading").hide();
        $('#modalKontak').modal('hide');
        $('#btnSave').text('Save');
        $('#btnSave').attr('disabled',false);
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
        $('#btnSave').text('Save');
        $('#btnSave').attr('disabled',false);
      }
    });
  }

  $(document).ready(function () {
    $("#loading").hide();

    $("#v-pills-payment-tab").click(function() {
      tableKontak = $('#datatable-kontak').DataTable({ 
        pagingType: "full_numbers",
        lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        destroy: true,
        responsive: false,
        processing: true,
        serverSide: true,
        order: [[1, 'desc']], //[2, 'desc']
        ajax: {
          "url": "{{ route('kontak.index') }}",
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
            data: 'Nama',
            name: 'Nama',
            className: 'text-start'
          },
          {
            data: 'Hubungan',
            name: 'Hubungan',
            className: 'text-start'
          },
          {
            data: 'NoHp',
            name: 'NoHp',
            className: 'text-start'
          },
          {
            data: 'Alamat',
            name: 'Alamat',
            className: 'text-start'
          },
          {
            data: 'CreatedDate',
            name: 'CreatedDate',
            className: 'text-center'
          }
        ]
      });
    });

    // tableKontak = $('#datatable-kontak').DataTable({ 
    //   pagingType: "full_numbers",
    //   lengthMenu: [
    //     [10, 25, 50, -1],
    //     [10, 25, 50, "All"]
    //   ],
    //   responsive: false,
    //   processing: true,
    //   serverSide: true,
    //   order: [[1, 'desc']], //[2, 'desc']
    //   ajax: {
    //     "url": "{{ route('kontak.index') }}",
    //     "type": "GET",
    //   },
    //   columns: [
    //     {
    //       data: 'DT_RowIndex', 
    //       name: 'DT_RowIndex',
    //       orderable: false, 
    //       searchable: false,
    //       className: 'text-end'
    //     },
    //     {
    //       data: 'action',
    //       name: 'action',
    //       orderable: false,
    //       searchable: false,
    //       className: 'text-center'
    //     },
    //     {
    //       data: 'Nama',
    //       name: 'Nama',
    //       className: 'text-start'
    //     },
    //     {
    //       data: 'Hubungan',
    //       name: 'Hubungan',
    //       className: 'text-start'
    //     },
    //     {
    //       data: 'NoHp',
    //       name: 'NoHp',
    //       className: 'text-start'
    //     },
    //     {
    //       data: 'Alamat',
    //       name: 'Alamat',
    //       className: 'text-start'
    //     },
    //     {
    //       data: 'CreatedDate',
    //       name: 'CreatedDate',
    //       className: 'text-center'
    //     }
    //   ]
    // });

    $("#NamaKontak").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#HubunganKontak").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#NoHpKontak").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#AlamatKontak").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });
  });
</script>