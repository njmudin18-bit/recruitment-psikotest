<!-- Modal Anak -->
<div class="modal fade" id="modalAnak" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="AnakForm">
          <input type="hidden" name="kodeAnak" id="kodeAnak">
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Nama:</label>
                <input type="text" name="NamaAnak" id="NamaAnak" class="form-control text-capitalize" placeholder="Contoh: John Doe">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Jenis kelamin:</label>
                <select name="JkAnak" id="JkAnak" class="form-select">
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
                <input type="text" name="TempatLahirAnak" id="TempatLahirAnak" class="form-control text-capitalize" placeholder="Contoh: Tangerang, Jakarta">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Tanggal lahir:</label>
                <input type="date" name="TanggalLahirAnak" id="TanggalLahirAnak" class="form-control" placeholder="Contoh: 4,500,000">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Pendidikan:</label>
                <select name="PendidikanAnak" id="PendidikanAnak" class="form-select">
                  <option value="" selected disabled>-- Pilih --</option>
                  <option value="Belum sekolah">Belum sekolah</option>
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
                <input type="text" name="PekerjaanAnak" id="PekerjaanAnak" class="form-control" placeholder="Contoh: Pelajar, Mahasiswa atau dll">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="btnSaveAnak" onclick="saveAnak()" type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<script>
  var save_method;
  var url;

  function openModalAnak() {
    save_method = 'add';
    $("#pass_div").show();
    $('#btnSaveAnak').text('Save');
    $('#AnakForm')[0].reset();
    $('.row').find(".has-error").removeClass("has-error");
    $('.help-block').empty();
    $('#modalAnak').modal('show');
    $('.modal-title').text('Tambah Anak');
  }

  function resetAnak() {
    $('#AnakForm')[0].reset();
    $('.modal-title').text('Tambah Anak');
  };

  function editAnak(id) {
    save_method = 'update';
    $('#kontakForm')[0].reset();
    $('.row').find(".has-error").removeClass("has-error");
    $('.help-block').empty();

    $.ajax({
      data: {
        "id": id,
        "_token": "{{ csrf_token() }}"
      },
      url: "{{ route('anak.edit') }}",
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        $('[name="kodeAnak"]').val(data.data.Id);
        $('[name="NamaAnak"]').val(data.data.Nama);
        $('[name="JkAnak"]').val(data.data.Jk);
        $('[name="TempatLahirAnak"]').val(data.data.TempatLahir);
        $('[name="TanggalLahirAnak"]').val(data.data.TanggalLahir);
        $('[name="PendidikanAnak"]').val(data.data.Pendidikan);
        $('[name="PekerjaanAnak"]').val(data.data.Pekerjaan);

        $('#modalAnak').modal('show');
        $('.modal-title').text('Edit Anak');
        $('#btnSaveAnak').text('Update');
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

  function hapusAnak(id) {
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
          url: "{{ route('anak.hapus') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            reload_table_anak();
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

  function reload_table_anak() {
    tableAnak.ajax.reload(null,false);
  };

  function saveAnak(e) {
    var url;
    if(save_method == 'add') {
      url = "{{ route('anak.save') }}";
    } else {
      url = "{{ route('anak.update') }}";
    }

    var formData = $('#AnakForm').serializeArray();
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
        reload_table_anak();
        $("#loading").hide();
        $('#modalAnak').modal('hide');
        $('#btnSaveAnak').text('Save');
        $('#btnSaveAnak').attr('disabled',false);
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
        $('#btnSaveAnak').text('Save');
        $('#btnSaveAnak').attr('disabled',false);
      }
    });
  }

  $(document).ready(function () {
    $("#loading").hide();

    $("#v-pills-confir-tab").click(function() {
      tableAnak = $('#datatable-anak').DataTable({ 
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
          "url": "{{ route('anak.index') }}",
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
            className: 'text-start'
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

    // tableAnak = $('#datatable-anak').DataTable({ 
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
    //     "url": "{{ route('anak.index') }}",
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
    //       className: 'text-start'
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

    $("#NamaAnak").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#JkAnak").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#TempatLahirAnak").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#TanggalLahirAnak").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#PendidikanAnak").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#PekerjaanAnak").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });
  });
</script>