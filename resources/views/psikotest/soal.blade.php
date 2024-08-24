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
                    {{ $SubTitle }} <strong class="text-danger text-uppercase">{{ $Ujian->Nama }}</strong>

                    @can('create ujian')
                    <button onclick="openModal()" class="btn btn-primary btn-sm ms-3 float-end">
                      <i class="mdi mdi-plus"></i> Tambah
                    </button>
                    @endcan

                    @can('create ujian')
                    <button onclick="openModalGambar()" class="btn btn-danger btn-sm ms-3 float-end">
                      <i class="mdi mdi-plus"></i> Tambah Tes Warna
                    </button>
                    @endcan

                    @can('create ujian')
                    <button onclick="openModalImportSoal()" class="btn btn-warning btn-sm ms-3 float-end">
                      <i class="mdi mdi-plus"></i> Import Soal
                    </button>
                    @endcan
                  </h5>
                  <div class="card-body">
                    <p class="card-title-desc">Tambah soal atau pertanyaan <strong class="text-danger">{{ $Ujian->Nama }}</strong> disini.</p>
                    <hr>
                    <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-bordered table-striped dt-responsive nowrap w-100 dataTable" width="150%">
                        <thead>
                          <tr class="bg-primary text-white text-center">
                            <th class="text-center" width="5%">No</th>
                            <th class="text-center" width="10%">#</th>
                            <th class="text-center" width="10%">Type</th>
                            <th class="text-center" width="10%">Kunci</th>
                            <th class="text-center" width="15%">Soal</th>
                            <th class="text-center" width="10%">A</th>
                            <th class="text-center" width="10%">B</th>
                            <th class="text-center" width="10%">C</th>
                            <th class="text-center" width="10%">D</th>
                            <th class="text-center" width="10%">E</th>
                            <th class="text-center" width="5%">Status</th>
                            <th class="text-center" width="5%">Gambar</th>
                            <th class="text-center" width="5%">Posisi</th>
                            <th class="text-center" width="18%">Created</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                    <h6 class="fw-bold mt-2 text-danger">Baca ini sebelum mengunggah file:</h6>
                    <ol class="mt-2">
                      <li class="text-danger">Hanya mengizinkan file png dan jpg.</li>
                      <li class="text-danger">Maximum ukuran file <strong>2MB</strong>.</li>
                      <li class="text-danger">Gunakan file converter generator online untuk merubah jenis file yang akan anda unggah atau klik <a class="fw-bold" href="https://www.freeconvert.com/" target="_blank">disini</a>.</li>
                      <li class="text-danger">Gunakan file resizer online untuk memperkecil ukuran gambar (.png). 
                        Klik <a class="fw-bold" href="https://imageresizer.com/" target="_blank">disini</a> untuk memperkecil ukuran gambar.
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

    <!-- Modal Import Soal -->
    <div class="modal fade" id="modalImportSoal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title import" id="exampleModalLabel">New message</h5>
            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="formImportSoal" enctype="multipart/form-data">
              <input type="hidden" name="kode" id="kode">
              <input type="hidden" name="IdUjian" id="IdUjian" value="{{ $Ujian->Id }}">
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-3">
                    <label for="recipient-name" class="col-form-label">Type Ujian:</label>
                    <select name="TypeUjian" id="TypeUjian" class="form-select">
                      <option value="" selected disabled>-- Pilih --</option>
                      @foreach ($TypeSoal as $item => $value)
                        <option value="{{ $value->Id }}">{{ $value->Nama }}</option>
                      @endforeach
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-md-3">
                    <label for="recipient-name" class="col-form-label">Status:</label>
                    <select name="StatusImportSoal" id="StatusImportSoal" class="form-select">
                      <option disabled selected>-- Pilih --</option>
                      <option value="AKTIF">AKTIF</option>
                      <option value="TIDAK">TIDAK</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="recipient-name" class="col-form-label">File:</label>
                    <input type="file" name="file" id="fileInput" accept=".xlsx, .xls" class="form-control">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-12">
                    <p class="fw-bold">NOTE: Download format <a href="{{ asset('format-import/FormatImportSoal.xlsx') }}" class="text-danger" download>import disini</a>.</p>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="btnImportSoal" onclick="import_file()" type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Test Warna -->
    <div class="modal fade" id="modalFormWarna" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title warna" id="exampleModalLabel">New message</h5>
            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="registerFormWarna" enctype="multipart/form-data">
              <input type="hidden" name="kode" id="kode">
              <input type="hidden" name="IdUjianWarna" id="IdUjianWarna" value="{{ $Ujian->Id }}">
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-4">
                    <label for="recipient-name" class="col-form-label">Type Ujian:</label>
                    <select name="TypeUjianWarna" id="TypeUjianWarna" class="form-select">
                      <option value="0" disabled>-- Pilih --</option>
                      @foreach ($TypeWarna as $item => $value)
                        <option selected value="{{ $value->Id }}">{{ $value->Nama }}</option>
                      @endforeach
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-md-4">
                    <label for="recipient-name" class="col-form-label">Kunci:</label>
                    <input type="text" name="KunciWarna" id="KunciWarna" class="form-control" maxlength="12" max="12" placeholder="Contoh: 25, 35 dst.">
                    <span class="help-block"></span>
                  </div>
                  <div class="col-md-4">
                    <label for="recipient-name" class="col-form-label">Status:</label>
                    <select name="StatusWarna" id="StatusWarna" class="form-select">
                      <option disabled selected>-- Pilih --</option>
                      <option value="AKTIF">AKTIF</option>
                      <option value="TIDAK">TIDAK</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Gambar:</label>
                    <input type="file" name="file" id="fileInput" class="form-control">
                    <span class="help-block"></span>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Posisi Gambar:</label>
                    <select name="PosisiGambarWarna" id="PosisiGambarWarna" class="form-select">
                      <option value="0" disabled>-- Pilih --</option>
                      <option value="Tengah" selected>Tengah</option>
                      <!-- <option value="Atas">Atas</option>
                      <option value="Bawah">Bawah</option> -->
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div id="ImageBoxWarna" class="col-md-4 col-sm-12 text-center mt-3">
                    <img id="ImagePreviewWarna" src="https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg" alt="" class="rounded avatar-lg" style="width: auto;">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-12">
                    NOTE:
                    <ol class="mt-2">
                      <li class="text-danger">Hanya mengizinkan file png dan jpg.</li>
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
            <button id="btnSaveWarna" onclick="save_test_warna()" type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Test Lainnya -->
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
              <input type="hidden" name="IdUjian" id="IdUjian" value="{{ $Ujian->Id }}">
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-8 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Soal:</label>
                    <textarea name="Soal" id="Soal" rows="2"></textarea>
                    <span class="help-block"></span>
                  </div>
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="recipient-name" class="col-form-label">Kunci:</label>
                        <select name="Kunci" id="Kunci" class="form-select">
                          <option value="0" selected disabled>-- Pilih --</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="D">D</option>
                          <option value="E">E</option>
                        </select>
                        <span class="help-block"></span>
                      </div>
                      <div class="col-md-6">
                        <label for="recipient-name" class="col-form-label">Status:</label>
                        <select name="Status" id="Status" class="form-select">
                          <option disabled selected>-- Pilih --</option>
                          <option value="AKTIF">AKTIF</option>
                          <option value="TIDAK">TIDAK</option>
                        </select>
                        <span class="help-block"></span>
                      </div>
                      <div class="col-md-12">
                        <label for="recipient-name" class="col-form-label">Type Ujian:</label>
                        <select name="TypeUjian" id="TypeUjian" class="form-select">
                          <option value="0" disabled selected>-- Pilih --</option>
                          @foreach ($Type as $item => $value)
                            <option value="{{ $value->Id }}">{{ $value->Nama }}</option>
                          @endforeach
                        </select>
                        <span class="help-block"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-3 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Jawaban A:</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">A.</span>
                      <input type="text" name="JawabanA" id="JawabanA" class="form-control text-capitalize" maxlength="255" placeholder="Isi jawaban A">
                      <span class="help-block"></span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Jawaban B:</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">B.</span>
                      <input type="text" name="JawabanB" id="JawabanB" class="form-control text-capitalize" maxlength="255" placeholder="Isi jawaban B">
                      <span class="help-block"></span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Jawaban C:</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">C.</span>
                      <input type="text" name="JawabanC" id="JawabanC" class="form-control text-capitalize" maxlength="255" placeholder="Isi jawaban C">
                      <span class="help-block"></span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Jawaban D:</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">D.</span>
                      <input type="text" name="JawabanD" id="JawabanD" class="form-control text-capitalize" maxlength="255" placeholder="Isi jawaban D">
                      <span class="help-block"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-3 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Jawaban E:</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1">E.</span>
                      <input type="text" name="JawabanE" id="JawabanE" class="form-control text-capitalize" maxlength="255" placeholder="Isi jawaban E">
                      <span class="help-block"></span>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Gambar:</label>
                    <input type="file" name="file" id="fileInput" class="form-control">
                    <span class="help-block"></span>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <label for="recipient-name" class="col-form-label">Posisi Gambar:</label>
                    <select name="PosisiGambar" id="PosisiGambar" class="form-select">
                      <option value="0" disabled>-- Pilih --</option>
                      <option value="None" selected>Tidak ada gambar</option>
                      <option value="Atas">Atas</option>
                      <option value="Bawah">Bawah</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                  <div id="ImageBox" class="col-md-3 col-sm-12 text-center mt-3">
                    <img id="ImagePreview" src="https://static.vecteezy.com/system/resources/previews/005/337/799/original/icon-image-not-found-free-vector.jpg" alt="" class="rounded avatar-lg" style="width: auto;">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-12">
                    NOTE:
                    <ol class="mt-2">
                      <li class="text-danger">Hanya mengizinkan file png dan jpg.</li>
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
    <x-js-summernote></x-js-summernote>
    @include('components.swaltoast')

    <script>
      var save_method;
      var url;

      function openModalImportSoal() {
        save_method = 'add';
        $('#btnImportSoal').text('Import');
        $('#formImportSoal')[0].reset();
        $('.row').find(".has-error").removeClass("has-error");
        $('.help-block').empty();
        $('#modalImportSoal').modal('show');
        $('.modal-title.import').text('Import soal ujian ' + '{{ $Ujian->Nama }}');
        $("#ImageBoxWarna").hide();
      }

      function import_file(files) {
        var form      = $('#formImportSoal')[0];
        var form_data = new FormData(form);
        form_data.append('_token', '{{ csrf_token() }}');

        $.ajax({
          url: "{{ route('import.soal') }}",
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
            $('#modalImportSoal').modal('hide');
            $('#btnImportSoal').text('Import');
            $('#btnImportSoal').attr('disabled',false);
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
            $('#btnImportSoal').text('Import');
            $('#btnImportSoal').attr('disabled', false);
          }
        });
      }

      function openModalGambar(params) {
        save_method = 'add';
        $('#btnSaveWarna').text('Save');
        $('#registerFormWarna')[0].reset();
        $('.row').find(".has-error").removeClass("has-error");
        $('.help-block').empty();
        $('#modalFormWarna').modal('show');
        $('.modal-title.warna').text('Tambah tes warna ujian ' + '{{ $Ujian->Nama }}');
        $("#ImageBoxWarna").hide();
      }

      function save_test_warna(files) {
        var url;
        if(save_method == 'add') {
          url = "{{ route('soal.save-test-warna') }}";
        } else {
          url = "{{ route('soal.update-test-warna') }}";
        }

        var form      = $('#registerFormWarna')[0];
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
            $('#modalFormWarna').modal('hide');
            $('#btnSaveWarna').text('Tambah Tes Warna');
            $('#btnSaveWarna').attr('disabled',false);
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
            $('#btnSaveWarna').text('Tambah Tes Warna');
            $('#btnSaveWarna').attr('disabled',false);
          }
        });
      }

      function openModal() {
        save_method = 'add';
        $("#pass_div").show();
        $('#btnSave').text('Save');
        $('#registerForm')[0].reset();
        $('.row').find(".has-error").removeClass("has-error");
        $('.help-block').empty();
        $('#modalForm').modal('show');
        $('.modal-title').text('Tambah soal ujian ' + '{{ $Ujian->Nama }}');
        $("#ImageBox").hide();
        $('#Soal').summernote('reset');
      }

      function reset() {
        $('#registerForm')[0].reset();
        $('.modal-title').text('Tambah Soal');
        $("#ImageBox").hide();
        $('#Soal').summernote('reset');
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
          url: "{{ route('soal.edit') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            let FileSource = "";
            if (data.data.Gambar == null) {
              FileSource = "https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg";
            } else {
              FileSource = "{{ url('/') }}/" + data.data.Gambar;
            }

            $('[name="kode"]').val(data.data.Id);
            $('#Soal').summernote('code', data.data.Soal);
            $('[name="JawabanA"]').val(data.data.A);
            $('[name="JawabanB"]').val(data.data.B);
            $('[name="JawabanC"]').val(data.data.C);
            $('[name="JawabanD"]').val(data.data.D);
            $('[name="JawabanE"]').val(data.data.E);
            $('[name="Kunci"]').val(data.data.Kunci);
            $('[name="PosisiGambar"]').val(data.data.PosisiGambar);
            $('[name="Status"]').val(data.data.Status);
            $('[name="TypeUjian"]').val(data.data.IdTypeUjian);
            $("#ImageBox").show();
            $('#ImagePreview').attr('src', FileSource);


            $('#modalForm').modal('show');
            $('.modal-title').text('Edit soal ujian ' + '{{ $Ujian->Nama }}');
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

      function edit_test_warna(id) {
        save_method = 'update';
        $('#registerFormWarna')[0].reset();
        $('.row').find(".has-error").removeClass("has-error");
        $('.help-block').empty();

        $.ajax({
          data: {
            "id": id,
            "_token": "{{ csrf_token() }}"
          },
          url: "{{ route('soal.edit') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            let FileSource = "";
            if (data.data.Gambar == null) {
              FileSource = "https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg";
            } else {
              FileSource = "{{ url('/') }}/" + data.data.Gambar;
            }

            $('[name="kode"]').val(data.data.Id);
            $('[name="KunciWarna"]').val(data.data.Kunci);
            $('[name="PosisiGambarWarna"]').val(data.data.PosisiGambar);
            $('[name="StatusWarna"]').val(data.data.Status);
            $('[name="TypeUjianWarna"]').val(data.data.IdTypeUjian);
            $("#ImageBoxWarna").show();
            $('#ImagePreviewWarna').attr('src', FileSource);


            $('#modalFormWarna').modal('show');
            $('.modal-title.warna').text('Edit tes warna ujian ' + '{{ $Ujian->Nama }}');
            $('#btnSaveWarna').text('Update');
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
              url: "{{ route('soal.hapus') }}",
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
        if ($('#Soal').summernote('isEmpty')) {
          alert("Soal tidak boleh kosong");
          $('#Soal').summernote({
            focus: true
          });
        } else {
          var url;
          if(save_method == 'add') {
            url = "{{ route('soal.save') }}";
          } else {
            url = "{{ route('soal.update') }}";
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
                $("#loading").hide();
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                  $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error');
                  $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
              } else {
                $("#loading").hide();
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
        $("#ImageBox").hide();

        $('#Soal').summernote({
          focus: true,
          height: 100,
          placeholder: 'Masukan soal disini.',
          toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            //[ 'fontsize', [ 'fontsize' ] ],
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
            "url": "{{ route('soal.index', ['id' => $Id]) }}",
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
              data: 'Kunci',
              name: 'Kunci',
              className: 'text-center'
            },
            {
              data: 'Soal',
              name: 'Soal',
              className: 'text-start'
            },
            {
              data: 'A',
              name: 'A',
              className: 'text-start'
            },
            {
              data: 'B',
              name: 'B',
              className: 'text-start'
            },
            {
              data: 'C',
              name: 'C',
              className: 'text-start'
            },
            {
              data: 'D',
              name: 'D',
              className: 'text-start'
            },
            {
              data: 'E',
              name: 'E',
              className: 'text-start'
            },
            {
              data: 'Status',
              name: 'Status',
              className: 'text-center'
            },
            {
              data: 'Gambar',
              name: 'Gambar',
              className: 'text-center'
            },
            {
              data: 'PosisiGambar',
              name: 'PosisiGambar',
              className: 'text-center'
            },
            {
              data: 'CreatedDate',
              name: 'CreatedDate',
              className: 'text-center'
            }
          ]
        });

        $("#Soal").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#JawabanA").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#JawabanB").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#JawabanC").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#JawabanD").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#JawabanE").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Kunci").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#Status").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#File").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#TypeUjianWarna").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#KunciWarna").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#StatusWarna").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#TypeUjian").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });

        $("#StatusImportSoal").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });
      });
    </script>
  </body>
</html>
