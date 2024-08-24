<!-- Modal Anak -->
<div class="modal fade" id="modalPasangan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="PasanganForm">
          <input type="hidden" name="kodePasangan" id="kodePasangan">
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Nama:</label>
                <input type="text" name="NamaPasangan" id="NamaPasangan" class="form-control text-capitalize" placeholder="Contoh: John Doe">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Jenis kelamin:</label>
                <select name="JkPasangan" id="JkPasangan" class="form-select">
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
                <input type="text" name="TempatLahirPasangan" id="TempatLahirPasangan" class="form-control text-capitalize" placeholder="Contoh: Tangerang, Jakarta">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Tanggal lahir:</label>
                <input type="date" name="TanggalLahirPasangan" id="TanggalLahirPasangan" class="form-control" placeholder="Contoh: 4,500,000">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Pendidikan:</label>
                <select name="PendidikanPasangan" id="PendidikanPasangan" class="form-select">
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
                <input type="text" name="PekerjaanPasangan" id="PekerjaanPasangan" class="form-control text-capitalize" placeholder="Contoh: PNS, Pegawai Swasta dll">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Nama perusahaan:</label>
                <input type="text" name="PerusahaanPasangan" id="PerusahaanPasangan" class="form-control text-capitalize" placeholder="Contoh: PT. MXXX AXXX SXXXXXXX">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Posisi/ Jabatan:</label>
                <input type="text" name="JabatanPasangan" id="JabatanPasangan" class="form-control text-capitalize" placeholder="Contoh: Staff">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Email:</label>
                <input type="text" name="EmailPasangan" id="EmailPasangan" class="form-control text-lowercase" placeholder="Contoh: john.doe@email.com">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">No handphone:</label>
                <input type="text" name="NoHpPasangan" id="NoHpPasangan" class="form-control" placeholder="Contoh: +62 8XX XXXX XXXX">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Alamat</label>
                <input type="text" name="AlamatPasangan" id="AlamatPasangan" class="form-control" placeholder="Contoh: Jl. Raya Bangka No. 18">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Akun sosial media</label>
                <input type="text" name="SosmedPasangan" id="SosmedPasangan" class="form-control" maxlength="150" placeholder="Contoh: https:faceboox.com">
                <span class="help-block"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="btnSavePasangan" onclick="savePasangan()" type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
<script>
  var save_method;
  var url;

  function openModalPasangan() {
    save_method = 'add';
    $("#pass_div").show();
    $('#btnSavePasangan').text('Save');
    $('#PasanganForm')[0].reset();
    $('.row').find(".has-error").removeClass("has-error");
    $('.help-block').empty();
    $('#modalPasangan').modal('show');
    $('.modal-title').text('Tambah Pasangan');
  }

  function resetPasangan() {
    $('#PasanganForm')[0].reset();
    $('.modal-title').text('Tambah Pasangan');
  };

  function editPasangan(id) {
    save_method = 'update';
    $('#PasanganForm')[0].reset();
    $('.row').find(".has-error").removeClass("has-error");
    $('.help-block').empty();

    $.ajax({
      data: {
        "id": id,
        "_token": "{{ csrf_token() }}"
      },
      url: "{{ route('keluarga.edit') }}",
      type: "POST",
      dataType: "JSON",
      success: function(data) {
        $('[name="kodePasangan"]').val(data.data.Id);
        $('[name="NamaPasangan"]').val(data.data.NamaPasangan);
        $('[name="JkPasangan"]').val(data.data.Jk);
        $('[name="TempatLahirPasangan"]').val(data.data.TempatLahir);
        $('[name="TanggalLahirPasangan"]').val(data.data.TanggalLahir);
        $('[name="PendidikanPasangan"]').val(data.data.Pendidikan);
        $('[name="PekerjaanPasangan"]').val(data.data.Pekerjaan);
        $('[name="PerusahaanPasangan"]').val(data.data.Perusahaan);
        $('[name="JabatanPasangan"]').val(data.data.Jabatan);
        $('[name="EmailPasangan"]').val(data.data.Email);
        $('[name="NoHpPasangan"]').val(data.data.NoHp);
        $('[name="AlamatPasangan"]').val(data.data.AlamatKtp);
        $('[name="SosmedPasangan"]').val(data.data.Sosmed);

        $('#modalPasangan').modal('show');
        $('.modal-title').text('Edit Pasangan');
        $('#btnSavePasangan').text('Update');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        Swal.fire(
          'Oops...',
          jqXHR.responseJSON.message,
          textStatus
        );
      }
    });
  };

  function hapusPasangan(id) {
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
          url: "{{ route('keluarga.hapus') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            reload_table_pasangan();
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
  };

  function reload_table_pasangan() {
    tablePasangan.ajax.reload(null,false);
  };

  function savePasangan(e) {
    var url;
    if(save_method == 'add') {
      url = "{{ route('keluarga.save') }}";
    } else {
      url = "{{ route('keluarga.update') }}";
    }

    var formData = $('#PasanganForm').serializeArray();
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
        reload_table_pasangan();
        $("#loading").hide();
        $('#modalPasangan').modal('hide');
        $('#btnSavePasangan').text('Save');
        $('#btnSavePasangan').attr('disabled',false);
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
        $('#btnSavePasangan').text('Save');
        $('#btnSavePasangan').attr('disabled',false);
      }
    });
  }

  $(document).ready(function () {
    $("#loading").hide();

    tablePasangan = $('#datatable-pasangan').DataTable({ 
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
        "url": "{{ route('keluarga.index') }}",
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
          data: 'NamaPasangan',
          name: 'NamaPasangan',
          className: 'text-start'
        },
        {
          data: 'Jk',
          name: 'Jk',
          className: 'text-center'
        },
        {
          data: 'NoHp',
          name: 'NoHp',
          className: 'text-start'
        },
        {
          data: 'Email',
          name: 'Email',
          className: 'text-start'
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
          className: 'text-center'
        },
        {
          data: 'CreatedDate',
          name: 'CreatedDate',
          className: 'text-center'
        }
      ]
    });

    $("#NamaPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#JkPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#TempatLahirPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#TanggalLahirPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#PendidikanPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#NoHpPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });
    
    $("#JabatanPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });
    
    $("#EmailPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#PekerjaanPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#PerusahaanPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#AlamatPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });

    $("#SosmedPasangan").change(function(){
      $(this).parent().removeClass('has-error');
      $(this).next().empty();
    });
  });
</script>