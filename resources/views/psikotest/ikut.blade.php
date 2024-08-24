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
                  <h5 class="card-header bg-transparent border-bottom">{{ $SubTitle }}</h5>
                  <div class="card-body">
                    <p class="card-title-desc">Silahkan pilih nama ujian yang telah diinstruksikan disini.</p>
                    <hr>
                    <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap w-100 dataTable" width="150%">
                        <thead>
                          <tr class="bg-primary text-white text-center">
                            <th class="text-center" width="5%">No</th>
                            <th class="text-center" width="5%">#</th>
                            <th class="text-center">Nama Ujian</th>
                            <th class="text-center" width="10%">Jlh. Soal</th>
                            <th class="text-center" width="10%">Durasi (Menit)</th>
                            <th class="text-center" width="15%">Tanggal Mulai</th>
                            <th class="text-center" width="15%">Tanggal Selesai</th>
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
            <h5 class="modal-title" id="exampleModalLabel">Anda akan mengikuti ujian</h5>
            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="registerForm">
              <input type="hidden" name="kode" id="kode">
              <p class="text-center">Anda akan mengikuti ujian<br> <span class="fw-bold text-uppercase" id="TextNamaUjian"></span></p>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">PIN:</label><!-- MZU3HM -->
                    <input type="text" name="Pin" id="Pin" value="" autocomplete="off" class="form-control text-uppercase text-center" placeholder="Masukan PIN ujian disini" autofocus maxlength="6" max="6">
                    <span class="help-block"></span>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer text-center justify-content-center">
            <button id="btnSave" onclick="check_pin()" type="button" class="btn btn-primary">Masuk ke ujian</button>
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

      function open_detail_OLD(Url){
        window.open(Url, '_blank');
      }

      function open_detail(Id, Url){
        $.ajax({
          url : "{{ route('check.biodata') }}",
          type: "POST",
          data: {
            UserId: Id,
            _token: '{{ csrf_token() }}'
          },
          dataType: "JSON",
          beforeSend: function (params) {
            $("#loading").show();
          },
          success: function(data)
          {
            console.log(data);
            $("#loading").hide();
            showToast('success', data.message);
            window.open(Url, '_blank');
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            let data = jqXHR.responseJSON;
            Swal.fire({
              title: "Oops",
              text: data.message,
              icon: data.status
            });
            $("#loading").hide();
            $('#btnSave').text('Masuk ke ujian');
            $('#btnSave').attr('disabled',false);
          }
        });
      }

      function open_modal_pin(Id, NamaUjian) {
        $('#kode').val(Id);
        $('#TextNamaUjian').html(NamaUjian);
        $('#modalForm').modal('show');
      }

      function check_pin() {
        var formData = $('#registerForm').serializeArray();
        formData.push({ name: "_token", value: "{{ csrf_token() }}" });
        $.ajax({
          url : "{{ route('ikuti.check_pin') }}",
          type: "POST",
          data: formData,
          dataType: "JSON",
          beforeSend: function (params) {
            $("#loading").show();
          },
          success: function(data)
          {
            showToast('success', data.message);
            window.open(data.url, '_blank');
            $("#loading").hide();
            $('#modalForm').modal('hide');
            $('#btnSave').text('Masuk ke ujian');
            $('#btnSave').attr('disabled',false);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
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
                title: "Oops", //capitalizeFirstLetter(textStatus),
                text: data.message,
                icon: data.status
              });
            }
            $("#loading").hide();
            $('#btnSave').text('Masuk ke ujian');
            $('#btnSave').attr('disabled',false);
          }
        });
      }

      function tambah_soal(url) {
        window.open(url, '_blank');
      }
      function reload_table() {
        table.ajax.reload(null,false);
      };

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
          order: [[1, 'desc']],
          ajax: {
            "url": "{{ route('ikuti-list.index') }}",
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
              data: 'StartDate',
              name: 'StartDate',
              className: 'text-start'
            },
            {
              data: 'EndDate',
              name: 'EndDate',
              className: 'text-start'
            },
          ]
        });

        $("#Pin").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });
      });
    </script>
  </body>
</html>
