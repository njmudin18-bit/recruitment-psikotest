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
    <style>
      .form-check-input {
        border: 1px solid rgb(31 28 28 / 94%);
      }

      .mt-auto {
        margin-top: auto;
      }

      .mb-auto {
        margin-bottom: auto;
      }
    </style> 
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
              <!-- end col -->
              <div class="col-md-3">
                <div class="card position-fixed d-md-block">
                  <h5 class="card-header bg-transparent border-bottom text-center">Navigasi Soal</h5>
                  <div class="card-body">
                    <div class="col-md-12 mb-2">
                      <div class="d-grid gap-2">
                        <div id="countdowntimer">
                          <span class="btn btn-danger" id="label_timer"></span>
                        </div>
                      </div>
                    </div>
                    @foreach ($Type as $key => $value)
                    <div class="col-md-12 mb-2">
                      <div class="d-grid gap-2">
                        <a href="#{{ preg_replace('/\s+/', '', $value->Nama) }}" class="btn btn-info waves-effect waves-light" title="Klik ini untuk pergi ke soal {{ $value->Nama }}" style="font-size: 12px; text-align:left;">
                          {{ $key+1 }}. {{ $value->Nama }}
                        </a>
                      </div>
                    </div>
                    @endforeach
                    <div class="col-md-12 mb-2">
                      <div class="d-grid gap-2">
                        <button id="btnSave" type="button" class="btn btn-danger" onclick="simpan_jawaban()">Simpan jawaban</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card">
                  <h5 class="card-header bg-transparent border-bottom">
                    {{ $SubTitle }} <span class="text-danger">{{ $Ujian->Nama }} {{ $Ujian->Acak }}</span>
                  </h5>
                  <div class="card-body">
                    <div class="col-md-12">
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-outline me-2"></i>
                        NOTE: <a href="#" class="fw-bold" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">Klik ini</a> dahulu sebelum mengisi soal!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    </div>
                    <form id="formUjian" action="" method="post">
                      <input type="hidden" name="IdUjian" value="{{ $Id }}">
                      @foreach ($Type as $key => $value)
                        <div class="col-md-12">
                          <h5 id="{{ preg_replace('/\s+/', '', $value->Nama) }}" class="mb-3 mt-2 fw-bold">{{ $key+1 }}. {{ $value->Nama }}</h5>
                          <h6 class="mb-3 mt-1">{!! $value->ContohSoal !!}</h6>
                          @php
                            $Query = \App\Models\SoalModel::where('Status', 'AKTIF')->where('IdTypeUjian', $value->Id);
                            if ($Ujian->Acak == 'YA') {
                              $Query->orderByRaw('RAND()');
                            }
                            $Data = $Query->get();
                          @endphp

                          @if($Data->isEmpty())
                            <p>No active records found.</p>
                          @else
                            <input type="hidden" name="JumlahSoal" value="{{ count($Data) }}">
                            @foreach($Data as $key => $item)
                              <div class="row">

                                @if($value->Nama != 'Tes Buta Warna')
                                <div class="col-md-12 col-sm-12 mt-2 mb-1 fw-bold">
                                  <div class="row">
                                    @if($item->PosisiGambar == 'Atas')
                                      @if($item->Gambar != null)
                                        <div class="col-md-12">
                                          <img class="rounded img-fluid mx-autoXX d-block mb-3 mt-3" width="200" src="{{ asset($item->Gambar) }}" data-holder-rendered="true">
                                        </div>
                                      @endif
                                    @endif
                                    <div class="col-md-12" style="display: flex;">
                                      <p>{{ $key+1 }}.&nbsp;{!! ucfirst($item->Soal) !!}</p>
                                      <input type="hidden" name="IdSoal[]" value="{{ $item->Id }}">
                                    </div>
                                    @if($item->PosisiGambar == 'Bawah')
                                      @if($item->Gambar != null)
                                        <div class="col-md-12">
                                          <img class="rounded img-fluid mx-autoXX d-block mb-3 mt-3" width="200" src="{{ asset($item->Gambar) }}" data-holder-rendered="true">
                                        </div>
                                      @endif
                                    @endif
                                  </div>
                                </div>
                                @endif

                                @if($value->Nama == 'Tes Buta Warna')
                                <div class="row mb-3">
                                  <div class="col-md-1 col-sm-12 mt-auto mb-auto">
                                    <p class="fw-bold">{{ $key+1 }}.&nbsp;{!! ucfirst($item->Soal) !!}</p>
                                    <input type="hidden" name="IdSoal[]" value="{{ $item->Id }}">
                                  </div>
                                  <div class="col-md-4 col-sm-12 mt-auto mb-auto">
                                    <img class="rounded img-fluid d-block mb-3 mt-3" width="200" src="{{ asset($item->Gambar) }}" data-holder-rendered="true">
                                  </div>
                                  <div class="col-md-4 col-sm-12 fw-bold mt-auto mb-auto">
                                    <input type="number" name="Pilihan[{{ $item->Id }}]" value="" class="form-control" placeholder="Jawaban No. {{ $key+1 }}">
                                  </div>
                                </div>
                                @endif

                                @if($item->A != '' || $item->A != null)
                                <div class="col-md{{ $value->Nama == 'Tes Aritmatika' ? '-3' : '-4' }} col-sm-12 mb-3">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Pilihan[{{ $item->Id }}]" value="A">
                                    <label class="form-check-label" for="formRadios1">A. {{ $item->A }}</label>
                                  </div>
                                </div>
                                @endif
                                @if($item->B != '' || $item->B != null)
                                <div class="col-md{{ $value->Nama == 'Tes Aritmatika' ? '-3' : '-4' }} col-sm-12 mb-3">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Pilihan[{{ $item->Id }}]" value="B">
                                    <label class="form-check-label" for="formRadios1">B. {{ $item->B }}</label>
                                  </div>
                                </div>
                                @endif
                                @if($item->C != '' || $item->C != null)
                                <div class="col-md{{ $value->Nama == 'Tes Aritmatika' ? '-3' : '-4' }} col-sm-12 mb-3">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Pilihan[{{ $item->Id }}]" value="C">
                                    <label class="form-check-label" for="formRadios1">C. {{ $item->C }}</label>
                                  </div>
                                </div>
                                @endif
                                @if($item->D != '' || $item->D != null)
                                <div class="col-md{{ $value->Nama == 'Tes Aritmatika' ? '-3' : '-4' }} col-sm-12 mb-3">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Pilihan[{{ $item->Id }}]" value="D">
                                    <label class="form-check-label" for="formRadios1">D. {{ $item->D }}</label>
                                  </div>
                                </div>
                                @endif
                                @if($item->E != '' || $item->E != null)
                                <div class="col-md{{ $value->Nama == 'Tes Aritmatika' ? '-3' : '-4' }} col-sm-12 mb-3">
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Pilihan[{{ $item->Id }}]" value="E">
                                    <label class="form-check-label" for="formRadios1">E. {{ $item->E }}</label>
                                  </div>
                                </div>
                                @endif
                              </div>
                            @endforeach
                          @endif
                          <hr>
                        </div>
                      @endforeach
                    </form>
                  </div>
                  <div class="card-footer bg-transparent border-top text-muted text-center">
                    <button id="btnSave" type="button" class="btn btn-danger" onclick="simpan_jawaban()">Simpan jawaban</button>
                  </div>
                </div>
              </div>
            </div> <!-- end row -->
          </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Petunjuk pengerjaan soal</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul>
              <li>Pastikan koneksi internet anda stabil.</li>
              <li>Jangan refresh halaman ini ketika sudah mengisi soal atau jawaban anda akan hilang.</li>
              <li>Baca dengan teliti masing-masing soal dan jawabannya.</li>
              <li>Anda bisa gunakan <strong>Navigasi soal</strong> untuk loncat ke kategori soal.</li>
              <li>Klik tanda x untuk menghilangkan halaman ini.</li>
              <li>Klik tombol <strong>Simpan jawaban</strong> yang ada di samping dan bawah soal, untuk menyelesaikan ujian ini.</li>
            </ul>
          </div>
        </div>
        
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
    <x-js-summernote></x-js-summernote>
    <script src="https://pagination.js.org/dist/2.6.0/pagination.js"></script>
    <script src="{{ asset('assets/jQuery.countdownTimer-2.0.0/js/jQuery.countdownTimer.js') }}"></script>
    @include('components.swaltoast')
    <script>
      var save_method;
      var url;

      function simpan_jawaban() {
        Swal.fire({
          title: "Sudah selesai?",
          text: "Harap periksa kembali soal yang dikerjakan. Jika sudah selesai klik tombol Ya, simpan.",
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, simpan",
          cancelButtonText: "Cek ulang",
          allowOutsideClick: false
        }).then((result) => {
          if (result.isConfirmed) {
            let JumlahSoalNew = 0; 
            $('input[name="JumlahSoal"]').each(function() {
              let value = parseFloat($(this).val());
              if (!isNaN(value)) {
                JumlahSoalNew += value;
              }
            });

            //console.log(JumlahSoalNew);
            var formData = $('#formUjian').serializeArray();
            formData.push({ name: "_token", value: "{{ csrf_token() }}" });
            formData.push({ name: "JumlahSoalNew", value: JumlahSoalNew });
            $.ajax({
              url : "{{ route('ikuti-ujian.simpan') }}",
              type: "POST",
              data: formData,
              dataType: "JSON",
              beforeSend: function (params) {
                $("#loading").show();
              },
              success: function(data)
              {
                let timerInterval;
                Swal.fire({
                  icon: "success",
                  title: "Selesai?",
                  html: data.message + " dan akan tertutup otomatis dalam <b></b> milliseconds.",
                  timer: 3000,
                  timerProgressBar: true,
                  allowOutsideClick: false,
                  didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                      timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    window.close()
                  }
                });
                $("#loading").hide();
                $('#btnSave').text('Simpan Jawaban');
                $('#btnSave').attr('disabled',false);
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                let data = jqXHR.responseJSON;
                let timerInterval;
                Swal.fire({
                  title: "Selesai!",
                  html: "Ujian akan tertutup otomatis dalam <b></b> milliseconds.",
                  timer: 3000,
                  icon: "success",
                  timerProgressBar: true,
                  allowOutsideClick: false,
                  didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector("b");
                    timerInterval = setInterval(() => {
                      timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                  },
                  willClose: () => {
                    clearInterval(timerInterval);
                  }
                }).then((result) => {
                  if (result.dismiss === Swal.DismissReason.timer) {
                    window.close();
                  }
                });
                $("#loading").hide();
                $('#btnSave').text('Simpan Jawaban');
                $('#btnSave').attr('disabled',false);
              }
            });
          }
        });
      }

      function simpan_jawaban_auto() {
        let JumlahSoalNew = 0;
            
        $('input[name="JumlahSoal"]').each(function() {
          let value = parseFloat($(this).val());
          if (!isNaN(value)) {
            JumlahSoalNew += value;
          }
        });

        //console.log(JumlahSoalNew);
        var formData = $('#formUjian').serializeArray();
        formData.push({ name: "_token", value: "{{ csrf_token() }}" });
        formData.push({ name: "JumlahSoalNew", value: JumlahSoalNew });
        $.ajax({
          url : "{{ route('ikuti-ujian.simpan') }}",
          type: "POST",
          data: formData,
          dataType: "JSON",
          beforeSend: function (params) {
            $("#loading").show();
          },
          success: function(data)
          {
            window.close();
            $("#loading").hide();
            $('#btnSave').text('Simpan Jawaban');
            $('#btnSave').attr('disabled',false);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            window.close();
            $("#loading").hide();
            $('#btnSave').text('Simpan Jawaban');
            $('#btnSave').attr('disabled',false);
          }
        });
      }

      $(document).ready(function () {
        $("#loading").hide();
      });
    </script>
    <script type="text/javascript">
      $(function() {
        $("#label_timer").countdowntimer({
          startDate : "{{ $StartDate }}",
          dateAndTime : "{{ $EndDate }}",
          size : "sm",
          displayFormat : "HMS",
          timeUp : timeIsUp
        });

        function timeIsUp() {
          let timerInterval;
          Swal.fire({
            icon: "info",
            title: "Waktu ujian habis!",
            html: "Jawaban anda akan tersimpan otomatis dalam <b></b> milliseconds.",
            timer: 5000,
            allowOutsideClick: false,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
              const timer = Swal.getPopup().querySelector("b");
              timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
              }, 100);
            },
            willClose: () => {
              clearInterval(timerInterval);
            }
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              simpan_jawaban_auto();
            }
          });
        }
      });
    </script>
  </body>
</html>
