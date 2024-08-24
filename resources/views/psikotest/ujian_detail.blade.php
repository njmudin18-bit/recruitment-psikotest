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
    <link href="{{ asset('assets/jQuery.countdownTimer-2.0.0/css/jQuery.countdownTimer.css') }}" rel="stylesheet" type="text/css" />
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
                    <form id="registerForm">
                      <input type="hidden" name="kode" id="kode" value="{{ $Ujian->Id }}">
                      <div class="row mb-2">
                        <div class="col-md-6 col-sm-12">
                          <label for="recipient-name" class="col-form-label">Nama Ujian:</label>
                          <input type="text" value="{{ $Ujian->Nama }}" name="TextNamaUjian" id="TextNamaUjian" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <label for="recipient-name" class="col-form-label">Durasi:</label>
                          <input type="text" value="{{ $Ujian->Durasi }}" name="TextDurasiUjian" id="TextDurasiUjian" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-md-6 col-sm-12">
                          <label for="recipient-name" class="col-form-label">Tanggal dan Jam Mulai:</label>
                          <input type="text" value="{{ $Ujian->StartDate }}" name="TextStartDateUjian" id="TextStartDateUjian" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <label for="recipient-name" class="col-form-label">Tanggal dan Jam Selesai:</label>
                          <input type="text" value="{{ $Ujian->EndDate }}" name="TextEndDateUjian" id="TextEndDateUjian" class="form-control" readonly>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-md-6 col-sm-12 text-center">
                          <label id="LabelDimulai" class="col-form-label">Ujian akan dimulai dalam:</label>
                          <label id="LabelBerlangsung" class="col-form-label">Ujian sedang berlangsung dan akan selesai dalam:</label>
                          <label id="LabelUjianSelesai" class="col-form-label">Ujian selesai:</label>
                          <br>
                          <div id="TimerDimulai" class="text-center">
                            <span id="IsiTimerDimulai"></span>
                          </div>
                          <div id="TimerBerlangsung" class="text-center">
                            <span id="IsiTimerBerlangsung"></span>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <label for="recipient-name" class="col-form-label">Pin:</label>
                          <input type="text" name="Pin" id="Pin" value="" autocomplete="off" class="form-control text-uppercase" placeholder="Masukan PIN ujian disini" autofocus maxlength="6" max="6" disabled>
                          <span class="help-block"></span>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="card-footer bg-transparent border-top text-muted text-center">
                    <button id="BtnIkutUjian" type="button" class="btn btn-danger" disabled onclick="check_pin()">Masukan PIN dan ikut ujian</button>
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
    
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/jQuery.countdownTimer-2.0.0/js/jQuery.countdownTimer.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <x-js-summernote></x-js-summernote>
    @include('components.swaltoast')
    <script type="text/javascript">
      $(function() {
        $("#IsiTimerDimulai").countdowntimer({
          startDate : "{{ $StartDate }}",
          dateAndTime : "{{ $EndDate }}",
          size : "lg",
          displayFormat : "HMS",
          timeUp : timeIsUp
        });

        $("#IsiTimerBerlangsung").countdowntimer({
          startDate : "{{ $LiveStartDate }}",
          dateAndTime : "{{ $LiveEndDate }}",
          size : "lg",
          displayFormat : "HMS",
          timeUp : ujianSelesai
        });

        function timeIsUp() {
          $("#BtnIkutUjian").attr('disabled', false);
          $("#Pin").attr('disabled', false);
          $("#countdowntimer").hide();
          $("#LabelDimulai").hide();
          $("#LabelBerlangsung").show();
          $("#TimerDimulai").hide();
          $("#TimerBerlangsung").show();
        }

        function ujianSelesai() {
          $("#BtnIkutUjian").attr('disabled', true);
          $("#Pin").attr('disabled', true);
          $("#LabelDimulai").hide();
          $("#LabelBerlangsung").hide();
          $("#LabelUjianSelesai").show();
        }
      });
    </script>
    <script>
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
            window.close();
            $("#loading").hide();
            $('#modalForm').modal('hide');
            $('#BtnIkutUjian').text('Masukan PIN dan ikut ujian');
            $('#BtnIkutUjian').attr('disabled',false);
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
            $('#BtnIkutUjian').text('Masukan PIN dan ikut ujian');
            $('#BtnIkutUjian').attr('disabled', false);
          }
        });
      }

      $(document).ready(function () {
        $("#loading").hide();
        //$("#TimerDimulai").show();
        $("#LabelBerlangsung").hide();
        $("#TimerBerlangsung").hide();
        $("#LabelUjianSelesai").hide();

        $("#Pin").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });
      });
    </script>
  </body>
</html>
