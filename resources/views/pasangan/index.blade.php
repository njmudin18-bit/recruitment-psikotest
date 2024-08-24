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

            <div class="checkout-tabs">
              <div class="row">
                <div class="col-xl-2 col-sm-3">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-shipping-tab" data-bs-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="true">
                      <i class="bx bxs-user-detail d-block check-nav-icon mt-4 mb-2"></i>
                      <p class="fw-bold mb-4">Pasangan</p>
                    </a>
                    <a class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false"> 
                      <i class="bx bxs-contact d-block check-nav-icon mt-4 mb-2"></i>
                      <p class="fw-bold mb-4">Kontak darurat</p>
                    </a>
                    <a class="nav-link" id="v-pills-confir-tab" data-bs-toggle="pill" href="#v-pills-confir" role="tab" aria-controls="v-pills-confir" aria-selected="false">
                      <i class="bx bx-happy d-block check-nav-icon mt-4 mb-2"></i>
                      <p class="fw-bold mb-4">Anak</p>
                    </a>
                    <a class="nav-link" id="v-pills-orangtua-tab" data-bs-toggle="pill" href="#v-pills-orangtua" role="tab" aria-controls="v-pills-orangtua" aria-selected="false">
                      <i class="bx bx-male d-block check-nav-icon mt-4 mb-2"></i>
                      <p class="fw-bold mb-4">Orangtua</p>
                    </a>
                    <a class="nav-link" id="v-pills-saudara-tab" data-bs-toggle="pill" href="#v-pills-saudara" role="tab" aria-controls="v-pills-saudara" aria-selected="false">
                      <i class="bx bx-body d-block check-nav-icon mt-4 mb-2"></i>
                      <p class="fw-bold mb-4">Saudara kandung</p>
                    </a>
                  </div>
                </div>
                <div class="col-xl-10 col-sm-9">
                  <div class="card">
                    <div class="card-body">
                      <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                          <div>
                            <h4 class="card-title">Pasangan (Suami/ Istri)</h4>
                            <p class="card-title-desc">Daftarkan nama pasangan anda (suami atau istri).</p>
                            <div class="row">
                              <div class="col-md-12 mb-2">
                                @can('create keluarga')
                                <button onclick="openModalPasangan()" class="btn btn-primary btn-sm ms-3 float-end">
                                  <i class="mdi mdi-plus"></i> Tambah
                                </button>
                                @endcan
                              </div>
                              <div class="col-md-12 mt-2">
                                <div class="table-responsive">
                                  <table id="datatable-pasangan" class="table table-striped table-bordered dt-responsive nowrap w-100 dataTable" width="125%">
                                    <thead>
                                      <tr class="bg-primary text-white text-center">
                                        <th class="text-center" width="10%">No</th>
                                        <th class="text-center" width="10%">#</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jk</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Handphone</th>
                                        <th class="text-center">TTL</th>
                                        <th class="text-center">Pendidikan</th>
                                        <th class="text-center">Pekerjaan</th>
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
                        <!-- KONTAK -->
                        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                          <div>
                            <h4 class="card-title">Kontak darurat</h4>
                            <p class="card-title-desc">Daftarkan nomor telepon yang bisa dihubungi diluar keluarga utama anda (ayah, ibu, istri, anak).</p>
                            <div class="row">
                              <div class="col-md-12 mb-2">
                                @can('create keluarga')
                                <button onclick="openModalKontak()" class="btn btn-primary btn-sm ms-3 float-end">
                                  <i class="mdi mdi-plus"></i> Tambah
                                </button>
                                @endcan
                              </div>
                              <div class="col-md-12 mt-2">
                                <div class="table-responsive">
                                  <table id="datatable-kontak" class="table table-striped table-bordered dt-responsive nowrap w-100 dataTable" width="125%">
                                    <thead>
                                      <tr class="bg-primary text-white text-center">
                                        <th class="text-center" width="10%">No</th>
                                        <th class="text-center" width="10%">#</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Hubungan</th>
                                        <th class="text-center">Telepon</th>
                                        <th class="text-center">Alamat</th>
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
                        <!-- ANAK -->
                        <div class="tab-pane fade" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
                          <div>
                            <h4 class="card-title">Anak</h4>
                            <p class="card-title-desc">Daftarkan semua nama anak anda dari yang paling besar dan kecil.</p>
                            <div class="row">
                              <div class="col-md-12 mb-2">
                                @can('create keluarga')
                                <button onclick="openModalAnak()" class="btn btn-primary btn-sm ms-3 float-end">
                                  <i class="mdi mdi-plus"></i> Tambah
                                </button>
                                @endcan
                              </div>
                              <div class="col-md-12 mt-2">
                                <div class="table-responsive">
                                  <table id="datatable-anak" class="table table-striped table-bordered dt-responsive nowrap w-100 dataTable" width="125%">
                                    <thead>
                                      <tr class="bg-primary text-white text-center">
                                        <th class="text-center" width="10%">No</th>
                                        <th class="text-center" width="10%">#</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">JK</th>
                                        <th class="text-center">TTL</th>
                                        <th class="text-center">Pendidikan</th>
                                        <th class="text-center">Pekerjaan</th>
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
                        <!-- ORANG TUA -->
                        <div class="tab-pane fade" id="v-pills-orangtua" role="tabpanel" aria-labelledby="v-pills-orangtua">
                          <div>
                            <h4 class="card-title">Orangtua</h4>
                            <p class="card-title-desc">Daftarkan nama orangtua anda mulai dari ayah dan ibu anda disini.</p>
                            <div class="row">
                              <div class="col-md-12 mb-2">
                                @can('create keluarga')
                                <button onclick="openModalOrangtua()" class="btn btn-primary btn-sm ms-3 float-end">
                                  <i class="mdi mdi-plus"></i> Tambah
                                </button>
                                @endcan
                              </div>
                              <div class="col-md-12 mt-2">
                                <div class="table-responsive">
                                  <table id="datatable-orangtua" class="table table-striped table-bordered dt-responsive nowrap w-100 dataTable" width="125%">
                                    <thead>
                                      <tr class="bg-primary text-white text-center">
                                        <th class="text-center" width="10%">No</th>
                                        <th class="text-center" width="10%">#</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jk</th>
                                        <th class="text-center">TTL</th>
                                        <th class="text-center">Pendidikan</th>
                                        <th class="text-center">Pekerjaan</th>
                                        <th class="text-center">Alamat</th>
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
                        <!-- SAUDARA KANDUNG -->
                        <div class="tab-pane fade" id="v-pills-saudara" role="tabpanel" aria-labelledby="v-pills-saudara">
                          <div>
                            <h4 class="card-title">Saudara kandung</h4>
                            <p class="card-title-desc">Daftarkan nama saudara kandung anda mulai dari kakak sampai adik anda disini.</p>
                            <div class="row">
                              <div class="col-md-12 mb-2">
                                @can('create keluarga')
                                <button onclick="openModalSaudara()" class="btn btn-primary btn-sm ms-3 float-end">
                                  <i class="mdi mdi-plus"></i> Tambah
                                </button>
                                @endcan
                              </div>
                              <div class="col-md-12 mt-2">
                                <div class="table-responsive">
                                  <table id="datatable-saudara" class="table table-striped table-bordered dt-responsive nowrap w-100 dataTable" width="125%">
                                    <thead>
                                      <tr class="bg-primary text-white text-center">
                                        <th class="text-center" width="10%">No</th>
                                        <th class="text-center" width="10%">#</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">JK</th>
                                        <th class="text-center">TTL</th>
                                        <th class="text-center">Pendidikan</th>
                                        <th class="text-center">Pekerjaan</th>
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
    @include('components.swaltoast')

    <!-- PASANGAN -->
    @include('components.js_pasangan')
    <!-- PASANGAN END -->

    <!-- KONTAK -->
    @include('components.js_kontak')
    <!-- KONTAK END -->

    <!-- ANAK -->
    @include('components.js_anak')
    <!-- ANAK END -->

    <!-- SAUDARA -->
    @include('components.js_saudara')
    <!-- SAUDARA END -->

    <!-- SAUDARA -->
    @include('components.js_orangtua')
    <!-- SAUDARA END -->
  </body>
</html>
