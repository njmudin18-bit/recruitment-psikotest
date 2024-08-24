<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>{{ $SubTitle }} | {{ config('appsproperties.APPS_NAME') }}</title>
    <!-- Meta header and App favicon start -->
    <x-meta-header :subtitle="$SubTitle"></x-metas>
    <!-- Meta header and App favicon end -->
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
                  <div class="card-body">
                    <h4 class="card-title mb-4">Personal Information</h4>
                    <p class="text-muted mb-4"></p>
                    <div class="row">
                      <label class="col-sm-3 col-form-label text-dark">Nama<span class="float-end">:</span></label>
                      <label class="col-sm-9 col-form-label text-dark"></label>
                    </div>
                    <div class="row">
                      <label class="col-sm-3 col-form-label text-dark">Email<span class="float-end">:</span></label>
                      <label class="col-sm-9 col-form-label text-dark"></label>
                    </div>
                    <div class="row">
                      <label class="col-sm-3 col-form-label text-dark">Phone<span class="float-end">:</span></label>
                      <label class="col-sm-9 col-form-label text-dark"></label>
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

    <!-- Loader start -->
    <x-loader-component></x-loader-component>
    <!-- Loader end -->
    
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @include('components.swaltoast')

    <script>
      $(document).ready(function () {
        $("#loading").hide();

      });
    </script>
  </body>
</html>
