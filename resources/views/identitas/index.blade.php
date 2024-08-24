<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>{{ $SubTitle }} | {{ config('appsproperties.APPS_NAME') }}</title>
    <!-- Meta header and App favicon start -->
    <x-meta-header :subtitle="$SubTitle"></x-metas>
    <!-- Meta header and App favicon end -->
    <!-- DataTables start -->
    <x-css-datatable></x-css-datatable>
    <!-- DataTables end -->
    <!-- Css standard start -->
    <x-css-standard></x-css-standard>
    <!-- Css standard end -->
  </head>
  <body data-sidebar="dark" data-layout-mode="light">
    <!-- Begin page -->
    <div id="layout-wrapper">
      <!-- Topbar start -->
      <x-top-bar />
      <!-- Topbar start end -->

      <!-- Left Sidebar Start -->
      <x-left-side-bar />
      <!-- Left Sidebar End -->

      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="main-content">
        <div class="page-content">
          <div class="container-fluid">
            <!-- start page title -->
            <x-page-title :title="$Title" :subtitle="$SubTitle" />
            <!-- end page title -->

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <h5 class="card-header bg-transparent border-bottom">
                    {{ $SubTitle }}

                    @can('create identitas')
                    <button onclick="openModal()" class="btn btn-primary btn-sm ms-3 float-end">
                      <i class="mdi mdi-plus"></i> Tambah
                    </button>
                    @endcan
                  </h5>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100 dataTable">
                        <thead>
                          <tr class="bg-primary text-white text-center">
                            <th class="text-center" width="5%">No</th>
                            <th class="text-center" width="10%">#</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center" width="5%">Usia</th>
                            <th class="text-center">Jk</th>
                            <th class="text-center">TTL</th>
                            <th class="text-center" width="18%">Created Date</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div> <!-- end col -->
            </div> <!-- end row -->
          </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        
        <!-- Footer start -->
        <x-footer-bar />
        <!-- Footer end -->
      </div>
      <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <x-right-side-bar />
    <!-- /Right-bar -->

    <!-- JAVASCRIPT start -->
    <x-js-standard></x-js-standard>
    <!-- JAVASCRIPT end -->

    <!-- Datatable start -->
    <x-js-datatable></x-js-datatable>
    <!-- Datatable end -->

    <!-- Datatable start -->
    <x-loader-component></x-loader-component>
    <!-- Datatable end -->

    <!-- Modal -->
    <div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="registerForm">
              <input type="hidden" name="kode" id="kode">
              <div class="row">
                <div class="col-md-3 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Department:</label>
                    <!-- <input type="text" name="Department" id="Department" class="form-control text-capitalize" placeholder="Contoh: Produksi, Purchasing, HRD dll."> -->
                    <select name="Department" id="Department" class="form-select">
                      <option selected disabled value="">-- Pilih --</option>
                      <option value="HRD">HRD</option>
                      <option value="IT">IT</option>
                      <option value="PPIC">PPIC</option>
                      <option value="Purchasing">Purchasing</option>
                      <option value="Finance">Finance</option>
                      <option value="Tax">Tax</option>
                      <option value="Maintenance">Maintenance</option>
                      <option value="Produksi">Produksi</option>
                      <option value="QC">QC</option>
                      <option value="R&D">R&D</option>
                      <option value="Pengawas Lapangan">Pengawas Lapangan</option>
                      <option value="Warehouse">Warehouse</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Posisi atau jabatan:</label>
                    <input type="text" name="Posisi" id="Posisi" class="form-control text-capitalize" placeholder="Contoh: Staff produksi">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Sumber info:</label>
                    <input type="text" name="SumberInfo" id="SumberInfo" class="form-control text-capitalize" placeholder="Contoh: Dari Bpk. John, Jobstreet, LinkedIn dll">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Gaji yang diminta:</label>
                    <input type="text" name="GajiDiminta" id="GajiDiminta" class="form-control" placeholder="Contoh: 4,500,000">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nama lengkap</label>
                    <input type="text" name="Nama" id="Nama" value="{{ Auth::user()->name }}" class="form-control text-capitalize" placeholder="Contoh: John Doe">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tempat lahir:</label>
                    <input type="text" name="TempatLahir" id="TempatLahir" class="form-control text-capitalize" placeholder="Contoh: Tangerang, Jakarta">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tanggal lahir:</label>
                    <input type="date" name="TanggalLahir" id="TanggalLahir" class="form-control" placeholder="Contoh: 4,500,000">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Jenis kelamin</label>
                    <select name="Jk" id="Jk" class="form-select">
                      <option value="" selected disabled>-- Pilih --</option>
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Status pernikahan:</label>
                    <select name="StatusNikah" id="StatusNikah" class="form-select">
                      <option value="" selected disabled>-- Pilih --</option>
                      <option value="BK">Belum kawin</option>
                      <option value="K">Kawin</option>
                      <option value="CH">Cerai hidup</option>
                      <option value="CM">Cerai mati</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nomor KTP:</label>
                    <input type="text" name="NoKtp" id="NoKtp" onkeypress="return isNumber(event)" maxlength="18" minlength="16" class="form-control" placeholder="Contoh: 8901X XXXX XXXX">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Alamat KTP</label>
                    <input type="text" name="AlamatKtp" id="AlamatKtp" class="form-control text-capitalize" placeholder="Masukan No Rumah, Jalan, RT, RW, Desa dll.">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Alamat Rumah Tinggal:</label>
                    <input type="text" name="AlamatRumahTinggal" id="AlamatRumahTinggal" class="form-control text-capitalize" placeholder="Masukan No Rumah, Jalan, RT, RW, Desa dll.">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Status kepemilikan tempat tinggal</label>
                    <select name="StatusKepemilikan" id="StatusKepemilikan" class="form-select">
                      <option value="" selected disabled>-- Pilih --</option>
                      <option value="Sendiri">Sendiri</option>
                      <option value="Keluarga">Keluarga</option>
                      <option value="Sewa">Sewa</option>
                      <option value="Kost">Kost</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">No handphone:</label>
                    <input type="text" name="NoHp" id="NoHp" class="form-control" maxlength="16" placeholder="Contoh: +62 8XX 9XXX 1XXX">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Email:</label>
                    <input type="text" name="Email" id="Email" value="{{ Auth::user()->email }}" readonly maxlength="75" class="form-control text-lowercase" placeholder="Contoh: john.doe@xxx.com">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Akun sosial media</label>
                    <input type="text" name="Sosmed" id="Sosmed" class="form-control" maxlength="150" placeholder="Contoh: https:faceboox.com">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Kewarganegaraan:</label>
                    <select name="Kewarganegaraan" id="Kewarganegaraan" class="form-select">
                      <option value="" selected disabled>-- Pilih --</option>
                      <option value="WNI">WNI</option>
                      <option value="WNA">WNA</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Agama:</label>
                    <select name="Agama" id="Agama" class="form-select">
                      <option value="" selected disabled>-- Pilih --</option>
                      <option value="Islam">Islam</option>
                      <option value="Protestan">Protestan</option>
                      <option value="Katolik">Katolik</option>
                      <option value="Hindu">Hindu</option>
                      <option value="Buddha">Buddha</option>
                      <option value="Khonghucu">Khonghucu</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Berat badan</label>
                    <input type="text" name="BeratBadan" id="BeratBadan" class="form-control" maxlength="3" placeholder="Contoh: 70" onkeypress="return isNumber(event)">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tinggi badan</label>
                    <input type="text" name="TinggiBadan" id="TinggiBadan" class="form-control" maxlength="3" placeholder="Contoh: 170" onkeypress="return isNumber(event)">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Golongan darah:</label>
                    <select name="GolDarah" id="GolDarah" class="form-select">
                      <option value="" selected disabled>-- Pilih --</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="AB">AB</option>
                      <option value="O">O</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Vaksin:</label>
                    <input type="text" name="Vaksin" id="Vaksin" class="form-control" placeholder="Contoh: Vaksin 1, 2, 3">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Alergi jika ada:</label>
                    <input type="text" name="Alergi" id="Alergi" class="form-control" placeholder="Contoh: Alergi debu dll.">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Pengobatan saat ini, jika ada:</label>
                    <input type="text" name="Pengobatan" id="Pengobatan" class="form-control" placeholder="Contoh: Pengobatan diabetes dll.">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="btnSave" onclick="save()" type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>
    
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('vendor/input-mask/jquery.maskMoney.min.js') }}"></script>
    @include('components.swaltoast')

    <script>
      var save_method;
      var url;

      function openModal() {
        save_method = 'add';
        $("#pass_div").show();
        $('#btnSave').text('Save');
        $('#registerForm')[0].reset();
        $('.row').find(".has-error").removeClass("has-error");
        $('.help-block').empty();
        $('#modalForm').modal('show');
        $('.modal-title').text('Tambah Identitas');
      }

      function reset() {
        $('#registerForm')[0].reset();
        $('.modal-title').text('Tambah Identitas');
      };

      function edit(id) {
        save_method = 'update';
        $('#registerForm')[0].reset();
        $('.row').find(".has-error").removeClass("has-error");
        $('.help-block').empty();

        $.ajax({
          data: {
            "id": id,
            "_token": "{{ csrf_token() }}"
          },
          url: "{{ route('identitas.edit') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            $('[name="kode"]').val(data.data.Id);
            $('[name="Department"]').val(data.data.Department);
            $('[name="Posisi"]').val(data.data.Posisi);
            $('[name="SumberInfo"]').val(data.data.SumberInfo);
            $('[name="GajiDiminta"]').val(formatNumber(data.data.GajiDiminta));
            $('[name="Nama"]').val(data.data.Nama);
            $('[name="TempatLahir"]').val(data.data.TempatLahir);
            $('[name="TanggalLahir"]').val(data.data.TanggalLahir);
            $('[name="Jk"]').val(data.data.Jk);
            $('[name="StatusNikah"]').val(data.data.StatusNikah);
            $('[name="NoKtp"]').val(data.data.NoKtp);
            $('[name="AlamatKtp"]').val(data.data.AlamatKtp);
            $('[name="AlamatRumahTinggal"]').val(data.data.AlamatRumahTinggal);
            $('[name="StatusKepemilikan"]').val(data.data.StatusKepemilikan);
            $('[name="NoHp"]').val(data.data.NoHp);
            $('[name="Email"]').val(data.data.Email);
            $('[name="Sosmed"]').val(data.data.Sosmed);
            $('[name="Kewarganegaraan"]').val(data.data.Kewarganegaraan);
            $('[name="Agama"]').val(data.data.Agama);
            $('[name="BeratBadan"]').val(data.data.BeratBadan);
            $('[name="TinggiBadan"]').val(data.data.TinggiBadan);
            $('[name="GolDarah"]').val(data.data.GolDarah);
            $('[name="Vaksin"]').val(data.data.Vaksin);
            $('[name="Alergi"]').val(data.data.Alergi);
            $('[name="Pengobatan"]').val(data.data.Pengobatan);

            $('#modalForm').modal('show');
            $('.modal-title').text('Edit Identitas');
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

      function hapus(id) {
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
              url: "{{ route('identitas.hapus') }}",
              type: "POST",
              dataType: "JSON",
              success: function(data) {
                reload_table();
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

      function view(id) {
        let URL = "{{ url('identitas-preview/') }}/" + id;
        window.open(URL, '_blank');
      }

      function reload_table() {
        table.ajax.reload(null,false);
      };

      function save(e) {
        var url;
        if(save_method == 'add') {
          url = "{{ route('identitas.save') }}";
        } else {
          url = "{{ route('identitas.update') }}";
        }

        var formData = $('#registerForm').serializeArray();
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
            reload_table();
            $("#loading").hide();
            $('#modalForm').modal('hide');
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

        $("#GajiDiminta").maskMoney({
          thousands: ',', // Use comma for thousands separator (optional)
          decimal: '.',   // Use dot for decimal separator (optional)
          precision: 0,   // Set number of decimal places (optional)
          allowZero: false, // Allow leading zero (optional)
          allowNegative: false  // Allow negative values (optional)
        });

        table = $('#datatable-buttons').DataTable({ 
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
            "url": "{{ route('identitas.index') }}",
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
              data: 'Usia',
              name: 'Usia',
              className: 'text-center'
            },
            {
              data: 'Jk',
              name: 'Jk',
              className: 'text-start'
            },
            {
              data: 'TTL',
              name: 'TTL',
              className: 'text-start'
            },
            {
              data: 'CreatedDate',
              name: 'CreatedDate',
              className: 'text-center'
            }
          ]
        });

        $("#Department").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Posisi").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#SumberInfo").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#GajiDiminta").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Nama").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#TempatLahir").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#TanggalLahir").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Jk").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#StatusNikah").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#NoKtp").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#AlamatKtp").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#AlamatRumahTinggal").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#StatusKepemilikan").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#NoHp").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Email").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Sosmed").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Kewarganegaraan").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Agama").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#BeratBadan").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#TinggiBadan").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#GolDarah").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });
      });
    </script>
  </body>
</html>
