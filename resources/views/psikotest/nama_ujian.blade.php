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
    <x-css-summernote></x-css-summernote>
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

                    @can('create ujian')
                    <button type="button" onclick="openModal()" class="btn btn-primary btn-sm ms-3 float-end">
                      <i class="mdi mdi-plus"></i> Tambah
                    </button>
                    @endcan
                  </h5>
                  <div class="card-body">
                    <p class="card-title-desc">Tambahkan nama ujian disini.</p>
                    <hr>
                    <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100 dataTable" width="150%">
                        <thead>
                          <tr class="bg-primary text-white text-center">
                            <th class="text-center" width="5%">No</th>
                            <th class="text-center" width="10%">#</th>
                            <th class="text-center" width="5%">PIN</th>
                            <th class="text-center">Nama Ujian</th>
                            <th class="text-center" width="5%">Acak</th>
                            <th class="text-center" width="5%">Jlh. Soal</th>
                            <th class="text-center" width="10%">Durasi (Menit)</th>
                            <th class="text-center" width="5%">Score</th>
                            <th class="text-center" width="5%">Status</th>
                            <th class="text-center" width="15%">Tanggal Mulai</th>
                            <th class="text-center" width="15%">Tanggal Selesai</th>
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
                <div class="col-md-6 col-sm-6">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nama Ujian:</label>
                    <input type="text" name="Nama" id="Nama" class="form-control text-capitalize" placeholder="Masukan nama ujian">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Acak Ujian:</label>
                    <select name="Acak" id="Acak" class="form-select">
                      <option disabled selected>-- Pilih --</option>
                      <option value="YA">YA</option>
                      <option value="TIDAK">TIDAK</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tanggal Mulai:</label>
                    <input type="datetime-local" name="StartDate" id="StartDate" class="form-control" placeholder="Masukan tanggal mulai ujian">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tanggal Selesai:</label>
                    <input type="datetime-local" name="EndDate" id="EndDate" class="form-control" placeholder="Masukan tanggal selesai ujian">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 col-sm-4">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Status:</label>
                    <select name="Status" id="Status" class="form-select">
                      <option disabled selected>-- Pilih --</option>
                      <option value="AKTIF">AKTIF</option>
                      <option value="TIDAK">TIDAK</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Durasi:</label>
                    <input type="number" name="Durasi" id="Durasi" class="form-control" placeholder="Contoh: 90, 60, 30">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Score per Soal:</label>
                    <input type="number" name="Score" id="Score" class="form-control" placeholder="Contoh: 1, 10, 20 dst.">
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
    <x-js-summernote></x-js-summernote>
    @include('components.swaltoast')

    <script>
      var save_method;
      var url;

      function tambah_soal(url) {
        window.open(url, '_blank');
      }

      function refresh_token(id) {
        $.ajax({
          data: {
            "id": id,
            "_token": "{{ csrf_token() }}"
          },
          url: "{{ route('refresh_pin') }}",
          type: "POST",
          dataType: "JSON",
          beforeSend: function(data) {
            $("#loading").show();
          },
          success: function(data) {
            $("#loading").hide();
            reload_table();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            $("#loading").hide();
            Swal.fire(
              'Oops...',
              jqXHR.responseJSON.message,
              textStatus
            );
          }
        });
      }

      function openModal() {
        save_method = 'add';
        $("#pass_div").show();
        $('#btnSave').text('Save');
        $('#registerForm')[0].reset();
        $('.mb-3').removeClass('has-error');
        $('.help-block').empty();
        $('#modalForm').modal('show');
        $('.modal-title').text('Tambah Nama Ujian');
      }

      function reset() {
        $('#registerForm')[0].reset();
        $('.modal-title').text('Tambah Nama Ujian');
      };

      function edit(id) {
        save_method = 'update';
        $('#registerForm')[0].reset();
        $('.mb-3').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
          data: {
            "id": id,
            "_token": "{{ csrf_token() }}"
          },
          url: "{{ route('nama-ujian.edit') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            $('[name="kode"]').val(data.data.Id);
            $('[name="Nama"]').val(data.data.Nama);
            $('[name="Acak"]').val(data.data.Acak);
            $('[name="StartDate"]').val(data.data.StartDate);
            $('[name="EndDate"]').val(data.data.EndDate);
            $('[name="Durasi"]').val(data.data.Durasi);
            $('[name="Status"]').val(data.data.Status);
            $('[name="Score"]').val(data.data.Score);

            $('#modalForm').modal('show');
            $('.modal-title').text('Edit Nama Ujian');
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
              url: "{{ route('nama-ujian.hapus') }}",
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

      function reload_table() {
        table.ajax.reload(null,false);
      };

      function save(e) {
        var url;
        if(save_method == 'add') {
          url = "{{ route('nama-ujian.save') }}";
        } else {
          url = "{{ route('nama-ujian.update') }}";
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
            "url": "{{ route('nama-ujian.index') }}",
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
              data: 'Pin',
              name: 'Pin',
              className: 'text-center'
            },
            {
              data: 'Nama',
              name: 'Nama',
              className: 'text-start'
            },
            {
              data: 'Acak',
              name: 'Acak',
              className: 'text-center'
            },
            {
              data: 'JumlahSoal',
              name: 'JumlahSoal',
              className: 'text-center'
            },
            {
              data: 'Durasi',
              name: 'Durasi',
              className: 'text-center'
            },
            {
              data: 'Score',
              name: 'Score',
              className: 'text-center'
            },
            {
              data: 'Status',
              name: 'Status',
              className: 'text-center'
            },
            {
              data: 'StartDate',
              name: 'StartDate',
              className: 'text-start'
            },
            {
              data: 'EndDate',
              name: 'EndDate',
              className: 'text-start'
            },
            {
              data: 'CreatedDate',
              name: 'CreatedDate',
              className: 'text-center'
            }
          ]
        });

        $("#Nama").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Acak").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Durasi").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#StartDate").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#EndDate").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Status").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Score").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });
      });
    </script>
  </body>
</html>
