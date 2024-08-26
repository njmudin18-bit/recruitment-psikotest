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

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
                    <div class="form-group row">
                      <label class="col-md-3 col-sm-12 col-form-label m-t-30">Filter date</label>
                      <div class="col-md-4 col-sm-12">
                        <div class="input-group" id="datepicker1">
                          <input type="text" class="form-control" name="tanggal" id="tanggal">
                          <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                        </div>

                        <input type="hidden" name="start_date" id="start_date">
                        <input type="hidden" name="end_date" id="end_date">
                      </div>
                      <div class="col-md-3 col-sm-12">
                        <button id="btnCari" type="button" class="btn btn-info btn-full-mobile" onclick="cari();">TAMPILKAN</button>
                      </div>
                    </div>
                    <hr class="hr-color">
                    <div class="table-responsive">
                      <table id="datatable-buttons" class="table table-bordered table-striped dt-responsive nowrap w-100 dataTable">
                        <thead>
                          <tr class="bg-primary text-white text-center">
                            <th class="text-center" width="5%">No</th>
                            <th class="text-center" width="10%">#</th>
                            <th class="text-center" width="10%">Department</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Posisi</th>
                            <th class="text-center" width="5%">Usia</th>
                            <th class="text-center" width="5%">JK</th>
                            <th class="text-center" width="10%">Phone</th>
                            <th class="text-center">Email</th>
                            <th class="text-center" width="10%">Tgl. Melamar</th>
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
    <div class="modal fade" id="ModalTable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="exampleModalLabel">Daftar dokumen <span id="NameLabel2"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="reset()"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table id="table-dox" class="table table-bordered table-striped dt-responsive nowrap w-100 dataTable">
                      <thead>
                        <tr class="bg-primary text-white text-center">
                          <th class="text-center" width="5%">No</th>
                          <th class="text-center">Nama Dokumen</th>
                          <th class="text-center" width="10%">Type</th>
                          <th class="text-center" width="10%">Extention</th>
                          <th class="text-center" width="15%">Size</th>
                          <th class="text-center" width="15%">Created date</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="reset()">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <x-js-summernote></x-js-summernote>
    @include('components.swaltoast')

    <script type="text/javascript">
      $(function() {

        var start = moment().startOf('month');
        var end   = moment();

        function cb(start, end) {
          var sd = start.format('YYYY-MM-DD');
          var ed = end.format('YYYY-MM-DD');

          $('#tanggal').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
          $('#start_date').val(start.format('YYYY-MM-DD'));
          $('#end_date').val(end.format('YYYY-MM-DD'));
        }

        $('#tanggal').daterangepicker({
          maxDate: new Date(),
          startDate: start,
          endDate: end,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          locale: {
            format: 'YYYY-MM-DD'
          },
          function(start, end, label) {
            startDate = start;
            endDate = end;
            console.log(startDate);
            console.log(endDate);
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
          }
        }, cb);
        cb(start, end);
      });
    </script>
    <script>
      function view(id) {
        let URL = "{{ url('identitas-preview/') }}/" + id;
        //console.log(URL);
        window.open(URL, '_blank');
      }

      //FUNCTION HAPUS
      function hapus(id, Nama) {
        Swal.fire({
          title: "Anda yakin?",
          text: "Ingin menghapus data " + Nama + " ?",
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
                "UserID": id,
                "_token": "{{ csrf_token() }}"
              },
              url: "{{ route('report.hapus-all') }}",
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
      
      //FUNCTION CARI
      function cari() {
        reload_table();
      }

      function reset(){
        tables.destroy();
      }

      //FUNCTION RELOAD TABLE
      function reload_table(){
        table.ajax.reload(null, false);
      }

      $(document).ready(function () {
        $("#loading").hide();

        table = $('#datatable-buttons').DataTable({
          dom: 'Bfrltip',
          buttons: [
            'excel' //'copy', 'csv', 'excel', 'pdf', 'print'
          ],
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
            "url": "{{ route('report.list') }}",
            "type": "POST",
            "data": function(data) {
              data.start_date   = $('#start_date').val();
              data.end_date     = $('#end_date').val();
              data._token       = "{{ csrf_token() }}";
            }
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
              data: 'Department',
              name: 'Department',
              className: 'text-start'
            },
            {
              data: 'Nama',
              name: 'Nama',
              className: 'text-start'
            },
            {
              data: 'Posisi',
              name: 'Posisi',
              className: 'text-start'
            },
            {
              data: 'TanggalLahir',
              name: 'TanggalLahir',
              className: 'text-end'
            },
            {
              data: 'Jk',
              name: 'Jk',
              className: 'text-center'
            },
            {
              data: 'NoHp',
              name: 'NoHp',
              className: 'text-center'
            },
            {
              data: 'Email',
              name: 'Email',
              className: 'text-start'
            },
            {
              data: 'TanggalDaftar',
              name: 'TanggalDaftar',
              className: 'text-center'
            }
          ]
        });

        $('#ModalTable').on('show.bs.modal', function (event) {
          const button      = $(event.relatedTarget); // Button that triggered the modal
          const recordId    = button.data('record-id');
          const recordName  = button.data('record-name');
          $("#NameLabel2").html(recordName);
          tables = $('#table-dox').DataTable({
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
              "url": "{{ route('report.document-list') }}",
              "type": "POST",
              "data": function(data) {
                data.UserID   = recordId;
                data._token   = "{{ csrf_token() }}";
              }
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
                className: 'text-start'
              }
            ]
          });
        });
      });
    </script>
  </body>
</html>
