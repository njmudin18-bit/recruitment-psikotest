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

                    @can('create pengalaman')
                    <button type="button" onclick="openModal()" class="btn btn-primary btn-sm ms-3 float-end">
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
                            <th class="text-center">Perusahaan</th>
                            <th class="text-center">Posisi</th>
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
                <div class="col-md-6 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Nama perusahaan:</label>
                    <input type="text" name="Perusahaan" id="Perusahaan" class="form-control text-capitalize" maxlength="75" placeholder="Contoh: PT. XXXX XXX">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Posisi:</label>
                    <input type="text" name="Posisi" id="Posisi" class="form-control text-capitalize" maxlength="75" placeholder="Contoh: Staff Produksi dll.">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tanggal mulai:</label>
                    <input type="date" name="StartDate" id="StartDate" class="form-control">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tanggal selesai:</label>
                    <input type="date" name="EndDate" id="EndDate" class="form-control">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Job Deskripsi:</label>
                    <textarea class="form-control" id="JobDesc" name="JobDesc"></textarea>
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

      function openModal() {
        save_method = 'add';
        $("#pass_div").show();
        $('#btnSave').text('Save');
        $('#registerForm')[0].reset();
        $('.row').find(".has-error").removeClass("has-error");
        $('.help-block').empty();
        $('#modalForm').modal('show');
        $('.modal-title').text('Tambah Pengalaman Kerja');
        $('#JobDesc').summernote('reset');
      }

      function reset() {
        $('#registerForm')[0].reset();
        $('.modal-title').text('Tambah Pengalaman Kerja');
        $('#JobDesc').summernote('reset');
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
          url: "{{ route('pengalaman.edit') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            $('[name="kode"]').val(data.data.Id);
            $('[name="Perusahaan"]').val(data.data.Perusahaan);
            $('[name="Posisi"]').val(data.data.Posisi);
            $('[name="StartDate"]').val(data.data.StartDate);
            $('[name="EndDate"]').val(data.data.EndDate);
            $('#JodDesc').summernote('code', data.data.Keterangan);

            $('#modalForm').modal('show');
            $('.modal-title').text('Edit Pengalaman Kerja');
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
              url: "{{ route('pengalaman.hapus') }}",
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
        if ($('#JobDesc').summernote('isEmpty')) {
          alert("Job Deskripsi tidak boleh kosong");
        } else {
          var url;
          if(save_method == 'add') {
            url = "{{ route('pengalaman.save') }}";
          } else {
            url = "{{ route('pengalaman.update') }}";
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
      }

      $(document).ready(function () {
        $("#loading").hide();

        $('#JobDesc').summernote({
          placeholder: 'Masukan deskripsi pekerjaan anda diperusahaan sebelumnya',
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
            "url": "{{ route('pengalaman.index') }}",
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
              data: 'Perusahaan',
              name: 'Perusahaan',
              className: 'text-start'
            },
            {
              data: 'Posisi',
              name: 'Posisi',
              className: 'text-start'
            },
            {
              data: 'StartDate',
              name: 'StartDate',
              className: 'text-center'
            },
            {
              data: 'EndDate',
              name: 'EndDate',
              className: 'text-center'
            },
            {
              data: 'CreatedDate',
              name: 'CreatedDate',
              className: 'text-center'
            }
          ]
        });

        $("#Perusahaan").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Posisi").change(function(){
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
      });
    </script>
  </body>
</html>
