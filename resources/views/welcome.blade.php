<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Portal | {{ config('appsproperties.APPS_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Portal | {{ config('appsproperties.APPS_NAME') }}">
		<meta name="description" content="{{ config('appsproperties.APPS_DESCRIPTION') }}">
		<meta name="keywords" content="{{ config('appsproperties.APPS_KEYWORD') }}">
		<meta name="subject" content="{{ config('appsproperties.APPS_NAME') }}">
		<meta name="language" content="ID">
		<meta name="author" content="{{ config('appsproperties.APPS_AUTHOR') }}">
		<meta name="designer" content="{{ config('appsproperties.APPS_AUTHOR') }}">
		<meta name="copyright" content="{{ config('appsproperties.APPS_COPYRIGHT') }}">
		<meta name="url" content="{{ url('') }}">
		<meta name="identifier-URL" content="{{ url('') }}">
		<meta name="robots" content="index, follow" />
		<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
		<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
		<link rel="canonical" href="{{ url('') }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(config('appsproperties.APPS_ICON')) }}">

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/assets/owl.theme.default.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/customs.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <style>
      .navigation.nav-sticky .navbar-nav .nav-item .nav-link {
          line-height: 48px;
          color: #fff;
      }
    </style>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#topnav-menu" data-bs-offset="60">
    <!-- Header start -->
    <x-header-landing></x-header-landing>
    <!-- Header end -->

    <!-- hero section start -->
    <section class="section hero-section bg-ico-hero" id="home">
      <div class="bg-overlay bg-primary"></div>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12 text-center">
            <div class="text-white-50">
              <h1 class="text-white fw-semibold mb-3 hero-title">Portal - Recruitment</h1>
              <p class="font-size-16 text-white">{{ config('appsproperties.APPS_DESCRIPTION') }}</p>
              
              <div class="flex-wrap gap-2 mt-4 text-center">
                <a href="{{ route('login') }}" class="btn btn-success text-black">Sign in</a>
                <a href="{{ route('register') }}" class="btn btn-danger text-black">Daftar</a>
              </div>
            </div>
          </div>
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- hero section end -->

    <!-- about section start -->
    <section class="section pt-4 bg-white" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center mb-5">
              <div class="small-title text-black fw-bold">Tentang aplikasi</div>
              <h2 class="text-black">Apa itu aplikasi eRecruitment</h2>
            </div>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-lg-5">
            <div class="text-black">
              <h3>Aplikasi eRecruitment</h3>
              <p>Aplikasi elektronik rekrutmen (e-recruitment app) adalah alat digital yang membantu perusahaan 
                mengelola proses rekrutmen secara online di {{ config('appsproperties.COMPANY_NAME') }}.</p>
              <p class="mb-4">Temukan kesempatan baru di sini dan jadilah bagian dari tim kami yang dinamis.</p>

              <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('login') }}" class="btn btn-success text-black">Sign in</a>
                <a href="{{ route('register') }}" class="btn btn-danger text-black">Daftar</a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 ms-auto">
            <div class="mt-4 mt-lg-0">
              <div class="row">
                <div class="col-sm-6">
                  <div class="card border">
                    <div class="card-body">
                      <div class="mb-3">
                        <i class="mdi mdi-file-document-multiple h1 text-success"></i>
                      </div>
                      <h5 class="text-black">Formulir</h5>
                      <p class="text-black mb-0">Lengkapi semua formulir yang dibutuhkan mulai dari 
                        Identitas diri, Pasangan, Orangtua, Anak dll.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card border mt-lg-5">
                    <div class="card-body">
                      <div class="mb-3">
                        <i class="mdi mdi-cloud-upload-outline h1 text-success"></i>
                      </div>
                      <h5 class="text-black">Dokumen</h5>
                      <p class="text-black mb-0">Unggah semua dokumen yang dibutuhkan mulai dari
                        Surat lamaran, CV, KTP, NPWP dll.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end container -->
    </section>
    <!-- about section end -->
    
    <!-- Faqs start -->
    <x-faqs :pertanyaanUmum="getPertanyaanUmum()" :privasiData="getPrivasiData()"></x-faqs>
    <!-- Faqs end -->

    <!-- Footer start -->
    <x-footer-landing></x-footer-landing>
    <!-- Footer end -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script> -->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('assets/libs/jquery.easing/jquery.easing.min.js') }}"></script>
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/jquery-countdown/jquery.countdown.min.js') }}"></script>
    <!-- owl.carousel js -->
    <script src="{{ asset('assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>
    <!-- ICO landing init -->
    <script src="{{ asset('assets/js/pages/ico-landing.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
  </body>
</html>
