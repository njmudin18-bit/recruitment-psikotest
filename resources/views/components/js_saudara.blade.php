<!-- Modal Anak -->
<div class="modal fade" id="modalSaudara" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="SaudaraForm">
          <input type="hidden" name="kodeSaudara" id="kodeSaudara">
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Nama:</label>
                <input type="text" name="NamaSaudara" id="NamaSaudara" class="form-control text-capitalize" placeholder="Contoh: John Doe">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Jenis kelamin:</label>
                <select name="JkSaudara" id="JkSaudara" class="form-select">
                  <option value="" selected disabled>-- Pilih --</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Tempat lahir:</label>
                <input type="text" name="TempatLahirSaudara" id="TempatLahirSaudara" class="form-control text-capitalize" placeholder="Contoh: Tangerang, Jakarta">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Tanggal lahir:</label>
                <input type="date" name="TanggalLahirSaudara" id="TanggalLahirSaudara" class="form-control" placeholder="Contoh: 4,500,000">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Pendidikan:</label>
                <select name="PendidikanSaudara" id="PendidikanSaudara" class="form-select">
                  <option value="" selected disabled>-- Pilih --</option>
                  <option value="SD">SD</option>
                  <option value="SMP">SMP</option>
                  <option value="SMA">SMA</option>
                  <option value="D1">D1</option>
                  <option value="D2">D2</option>
                  <option value="D3">D3</option>
                  <option value="D4">D4</option>
                  <option value="S1">S1</option>
                  <option value="S2">S2</option>
                  <option value="S3">S3</option>
                </select>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Pekerjaan:</label>
                <input type="text" name="PekerjaanSaudara" id="PekerjaanSaudara" class="form-control" placeholder="Contoh: Pelajar, Mahasiswa atau dll">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="btnSaveSaudara" onclick="saveSaudara()" type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<script>
  var save_method;
  var url;

  function openModalSaudara() {
    save_method = 'add';
    $("#pass_div").show();
    $('#btnSaveSaudara').text('Save');
    $('#SaudaraForm')[0].reset();
    $('.row').find(".has-error").removeClass("has-error");
    $('.help-block').empty();
    $('#modalSaudara').modal('show');
    $('.modal-title').text('Tambah Saudara');
  }

  function resetSaudara() {
    $('#SaudaraForm')[0].reset();
    $('.modal-title').text('Tambah Saudara');
  };

  function editSaudara(id) {
    save_method = 'update';
    $('#SaudaraForm')[0].reset();
    $('.row').find(".has-error").removeClass("has-error");
    $('.help-block').empty();

    $.ajax({
      data: {
        "id": id,
        "_token": "{{ csrf_token() }}"
      },
      url: "{{ route('saudara.edit') }}",
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        $('[name="kodeSaudara"]').val(data.data.Id);
        $('[name="NamaSaudara"]').val(data.data.Nama);
        $('[name="JkSaudara"]').val(data.data.Jk);
        $('[name="TempatLahirSaudara"]').val(data.data.TempatLahir);
        $('[name="TanggalLahirSaudara"]').val(data.data.TanggalLahir);
        $('[name="PendidikanSaudara"]').val(data.data.Pendidikan);
        $('[name="PekerjaanSaudara"]').val(data.data.Pekerjaan);

        $('#modalSaudara').modal('show');
        $('.modal-title').text('Edit Saudara');
        $('#btnSaveSaudara').text('Update');
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

  function hapusSaudara(id) {
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
          url: "{{ route('saudara.hapus') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            reload_table_saudara();
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

  function reload_table_saudara() {
    tableSaudara.ajax.reload(null,false);
  };

  function saveSaudara(e) {
    var url;
    if(save_method == 'add') {
      url = "{{ route('saudara.save') }}";
    } else {
      url = "{{ route('saudara.update') }}";
    }

    var formData = $('#SaudaraForm').serializeArray();
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
        reload_table_saudara();
        $("#loading").hide();
        $('#modalSaudara').modal('hide');
        $('#btnSaveSaudara').text('Save');
        $('#btnSaveSaudara').attr('disabled',false);
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
        $('#btnSaveSaudara').text('Save');
        $('#btnSaveSaudara').attr('disabled',false);
      }
    });
  }

  $(document).ready(function () {
    $("#loading").hide();

    $("#v-pills-saudara-tab").click(function() {
      tableSaudara = $('#datatable-saudara').DataTable({ 
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
          "url": "{{ route('saudara.index') }}",
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
            data: 'Jk',
            name: 'Jk',
            className: 'text-center'
          },
          {
            data: 'TTL',
            name: 'TTL',
            className: 'text-start'
          },
          {
            data: 'Pendidikan',
            name: 'Pendidikan',
            className: 'text-center'
          },
          {
            data: 'Pekerjaan',
            name: 'Pekerjaan',
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

    // tableSaudara = $('#datatable-saudara').DataTable({ 
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
    //     "url": "{{ route('saudara.index') }}",
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
    //       data: 'Jk',
    //       name: 'Jk',
    //       className: 'text-center'
    //     },
    //     {
    //       data: 'TTL',
    //       name: 'TTL',
    //       className: 'text-start'
    //     },
    //     {
    //       data: 'Pendidikan',
    //       name: 'Pendidikan',
    //       className: 'text-center'
    //     },
    //     {
    //       data: 'Pekerjaan',
    //       name: 'Pekerjaan',
    //       className: 'text-start'
    //     },
    //     {
    //       data: 'CreatedDate',
    //       name: 'CreatedDate',
    //       className: 'text-center'
    //     }
    //   ]
    // });

    $("#NamaSaudara").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#JkSaudara").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#TempatLahirSaudara").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#TanggalLahirSaudara").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#PendidikanSaudara").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#PekerjaanSaudara").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });
  });
</script>