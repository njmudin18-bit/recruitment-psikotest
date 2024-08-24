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

            <div class="checkout-tabs">
              <div class="row">
                <div class="col-xl-2 col-sm-3">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-shipping-tab" data-bs-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="true">
                      <i class="bx bxs-crown d-block check-nav-icon mt-4 mb-2"></i>
                      <p class="fw-bold mb-4">Skill, Bahasa dll.</p>
                    </a>
                    <a class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false"> 
                      <i class="bx bxs-graduation d-block check-nav-icon mt-4 mb-2"></i>
                      <p class="fw-bold mb-4">Pendidikan, Organisasi dll.</p>
                    </a>
                    <a class="nav-link" id="v-pills-confir-tab" data-bs-toggle="pill" href="#v-pills-confir" role="tab" aria-controls="v-pills-confir" aria-selected="false">
                      <i class="bx bxs-comment-add d-block check-nav-icon mt-4 mb-2"></i>
                      <p class="fw-bold mb-4">Pertanyaan lainnya</p>
                    </a>
                  </div>
                </div>
                <div class="col-xl-10 col-sm-9">
                  <div class="card">
                    <div class="card-body">
                      <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                          <div>
                            <h4 class="card-title">Catatan tambahan satu</h4>
                            <p class="card-title-desc">Skill, Keterampilan, Bahasa, Olahraga, Keorganisasian dll yang pernah atau saat ini sedang diikuti.</p>
                            <div class="row">
                              <div class="col-md-12 mb-2">
                                @can('create catatan')
                                <button type="button" onclick="openModalTambahanSatu()" class="btn btn-primary btn-sm ms-3 float-end">
                                  <i class="mdi mdi-plus"></i> Tambah
                                </button>
                                @endcan
                              </div>
                              <div class="col-md-12 mt-2">
                                <div class="table-responsive">
                                  <table id="datatable-tambahan-satu" class="table table-bordered table-striped dt-responsive nowrap w-100 dataTable">
                                    <thead>
                                      <tr class="bg-primary text-white text-center">
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="10%">#</th>
                                        <th class="text-center" width="10%">Waktu</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center" width="18%">Created Date</th>
                                      </tr>
                                    </thead>
                                    <tbody></tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                          <div>
                            <h4 class="card-title">Catatan tambahan dua</h4>
                            <p class="card-title-desc">Pendidikan, pengembangan lain yang sedang atau ingin dilakukan dalam 2 tahun kedepan.</p>
                            <div class="row">
                              <div class="col-md-12 mb-2">
                                @can('create catatan')
                                <button type="button" onclick="openModalTambahanDua()" class="btn btn-primary btn-sm ms-3 float-end">
                                  <i class="mdi mdi-plus"></i> Tambah
                                </button>
                                @endcan
                              </div>
                              <div class="col-md-12 mt-2">
                                <div class="table-responsive">
                                  <table id="datatable-tambahan-dua" class="table table-bordered table-striped   dt-responsive nowrap w-100 dataTable">
                                    <thead>
                                      <tr class="bg-primary text-white text-center">
                                        <th class="text-center" width="10%">No</th>
                                        <th class="text-center" width="10%">#</th>
                                        <th class="text-center">Nama Instansi</th>
                                        <th class="text-center" width="10%">Waktu</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center" width="18%">Created Date</th>
                                      </tr>
                                    </thead>
                                    <tbody></tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
                          <div>
                            <h4 class="card-title">Catatan tambahan tiga</h4>
                            <p class="card-title-desc">Jawab pertanyaan dibawah sesuai dengan keadaan dan kondisi anda saat ini.</p>
                            <form id="FormPertanyaan">
                              <div class="row">
                                <div class="col-md-12 mb-2">
                                  @can('create catatan')
                                  <button type="button" onclick="SimpanJawaban()" class="btn btn-primary btn-sm ms-3 float-end">
                                    <i class="mdi mdi-content-save-all"></i> Simpan
                                  </button>
                                  @endcan
                                </div>
                                <div class="col-md-12 mt-2">
                                  <div class="table-responsive">
                                    <table id="datatable-tambahan-tiga" class="table table-bordered table-striped dt-responsive nowrap w-100 dataTable" width="200%">
                                      <thead>
                                        <tr class="bg-primary text-white text-center">
                                          <th rowspan="2" width="5%">No</th>
                                          <th colspan="2" width="20%">Jawaban</th>
                                          <th rowspan="2" width="50%">Pertanyaan</th>
                                        </tr>
                                        <tr class="bg-primary text-white text-center">
                                          <th width="10%">Ya</th>
                                          <th width="10%">Tidak</th>
                                        </tr>
                                      </thead>
                                      <tbody id="body-tiga"></tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
    <x-js-summernote></x-js-summernote>
    @include('components.swaltoast')

    <!-- TAMBAHAN SATU -->
    @include('components.js_tambahansatu')
    <!-- TAMBAHAN SATU END -->

    <!-- TAMBAHAN DUA -->
    @include('components.js_tambahandua')
    <!-- TAMBAHAN DUA END -->

    <!-- TAMBAHAN TIGA -->
    @include('components.js_tambahantiga')
    <!-- TAMBAHAN TIGA END -->
  </body>
</html>
