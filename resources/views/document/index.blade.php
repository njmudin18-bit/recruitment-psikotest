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

                    @can('create dokumen')
                    <button onclick="openModal()" class="btn btn-primary btn-sm ms-3 float-end">
                      <i class="mdi mdi-plus"></i> Tambah
                    </button>
                    @endcan
                  </h5>
                  <div class="card-body">
                    <p class="card-title-desc">Upload Surat lamaran, CV, KTP, NPWP**, 
                      Ijazah, SKCK, KK, Surat dokter dan Surat vaksin untuk kelengkapan data diri anda.</p>
                    <hr>
                    <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-bordered table-striped dt-responsive nowrap w-100 dataTable">
                        <thead>
                          <tr class="bg-primary text-white text-center">
                            <th class="text-center" width="5%">No</th>
                            <th class="text-center" width="10%">#</th>
                            <th class="text-center" width="15%">Nama Dok.</th>
                            <th class="text-center">Type Dok.</th>
                            <th class="text-center" width="5%">Ext Dok.</th>
                            <th class="text-center" width="10%">Ukuran Dok.</th>
                            <th class="text-center" width="18%">Created</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                    <h6 class="fw-bold mt-2 text-danger">Baca ini sebelum mengunggah file:</h6>
                    <ol class="mt-2">
                      <li class="text-danger"><strong>**</strong> Opsional jika ada.</li>
                      <li class="text-danger">Hanya mengizinkan file png dan pdf.</li>
                      <li class="text-danger">Maximum ukuran file <strong>2MB</strong>.</li>
                      <li class="text-danger">Gunakan file converter generator online untuk merubah jenis file yang akan anda unggah atau klik <a class="fw-bold" href="https://www.freeconvert.com/" target="_blank">disini</a>.</li>
                      <li class="text-danger">Gunakan file resizer online untuk memperkecil ukuran gambar (.png). 
                        Klik <a class="fw-bold" href="https://imageresizer.com/" target="_blank">disini</a> untuk memperkecil ukuran gambar.
                      </li>
                      <li class="text-danger">Gunakan file resizer online untuk memperkecil ukuran pdf. 
                        Klik <a class="fw-bold" href="https://www.ilovepdf.com/compress_pdf" target="_blank">disini</a> untuk memperkecil ukuran pdf.
                      </li>
                    </ol>
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
            <form id="registerForm" enctype="multipart/form-data">
              <input type="hidden" name="kode" id="kode">
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Nama Dokumen:</label>
                    <input type="text" name="NamaDokumen" id="NamaDokumen" class="form-control text-capitalize" maxlength="75" placeholder="Contoh: KTP-John Doe">
                    <span class="help-block"></span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Type Dokumen:</label>
                    <select name="TypeDokumen" id="TypeDokumen" class="form-select">
                      <option value="" selected disabled>-- Pilih --</option>
                      <option value="Lamaran">Surat Lamaran</option>
                      <option value="CV">CV</option>
                      <option value="KTP">KTP</option>
                      <option value="NPWP">NPWP</option>
                      <option value="Ijazah">Ijazah</option>
                      <option value="SKCK">SKCK</option>
                      <option value="KK">Kartu Keluarga</option>
                      <option value="Dokter">Surat Dokter</option>
                      <option value="Vaksin">Surat Vaksin</option>
                      <option value="Foto">Pas Foto</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-8 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Dokumen:</label>
                    <input type="file" name="file" id="fileInput" class="form-control">
                    <span class="help-block"></span>
                  </div>
                  <div id="ImageBox" class="col-md-4 col-sm-12 text-center mt-3">
                    <img id="ImagePreview" src="https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg" alt="" class="rounded avatar-lg">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-12">
                    NOTE:
                    <ol class="mt-2">
                      <li class="text-danger">Hanya mengizinkan file png dan pdf.</li>
                      <li class="text-danger">Maximum ukuran file <strong>2MB</strong>.</li>
                      <li class="text-danger">Gunakan file converter generator online untuk merubah jenis file yang akan anda unggah atau klik <a class="fw-bold" href="https://www.freeconvert.com/" target="_blank">disini</a>.</li>
                      <li class="text-danger">Gunakan file resizer online untuk memperkecil ukuran gambar (.png). 
                        Klik <a class="fw-bold" href="https://imageresizer.com/" target="_blank">disini</a> untuk memperkecil ukuran gambar.
                      </li>
                      <li class="text-danger">Gunakan file resizer online untuk memperkecil ukuran pdf. 
                        Klik <a class="fw-bold" href="https://www.ilovepdf.com/compress_pdf" target="_blank">disini</a> untuk memperkecil ukuran pdf.
                      </li>
                    </ol>
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
        $('.modal-title').text('Tambah Dokumen');
        $("#ImageBox").hide();
      }

      function reset() {
        $('#registerForm')[0].reset();
        $('.modal-title').text('Tambah Dokumen');
        $("#ImageBox").hide();
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
          url: "{{ route('dokumen.edit') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            console.log(data);
            let FileSource = "";
            if (data.data.TypeFile == 'pdf') {
              FileSource = "https://png.pngtree.com/png-clipart/20220612/original/pngtree-pdf-file-icon-png-png-image_7965915.png";
            } else {
              FileSource = "{{ url('/') }}/" + data.data.File;
            }

            $('[name="kode"]').val(data.data.Id);
            $('[name="NamaDokumen"]').val(data.data.NamaDokumen);
            $('[name="TypeDokumen"]').val(data.data.TypeDokumen);
            $("#ImageBox").show();
            $('#ImagePreview').attr('src', FileSource);


            $('#modalForm').modal('show');
            $('.modal-title').text('Edit Dokumen');
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
              url: "{{ route('dokumen.hapus') }}",
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

      function save(files) {
        var url;
        if(save_method == 'add') {
          url = "{{ route('dokumen.save') }}";
        } else {
          url = "{{ route('dokumen.update') }}";
        }

        var form      = $('#registerForm')[0];
        var form_data = new FormData(form);
        form_data.append('_token', '{{ csrf_token() }}');

        $.ajax({
          url: url,
          dataType: 'JSON', 
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'POST',
          beforeSend: function (response) {
            $("#loading").show();
          },
          success: function (data) {
            showToast('success', data.message);
            reload_table();
            $("#loading").hide();
            $('#modalForm').modal('hide');
            $('#btnSave').text('Save');
            $('#btnSave').attr('disabled',false);
          },
          error: function (jqXHR, textStatus, errorThrown) {
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
        $("#ImageBox").hide();

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
            "url": "{{ route('dokumen.index') }}",
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
              data: 'NamaDokumen',
              name: 'NamaDokumen',
              className: 'text-start'
            },
            {
              data: 'TypeDokumen',
              name: 'TypeDokumen',
              className: 'text-start'
            },
            {
              data: 'TypeFile',
              name: 'TypeFile',
              className: 'text-center'
            },
            {
              data: 'UkuranFile',
              name: 'UkuranFile',
              className: 'text-end'
            },
            {
              data: 'CreatedDate',
              name: 'CreatedDate',
              className: 'text-center'
            }
          ]
        });

        $("#NamaDokumen").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#TypeDokumen").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#File").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });
      });
    </script>
  </body>
</html>
