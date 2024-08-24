<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>{{ $Title }} | {{ config('appsproperties.APPS_NAME') }}</title>
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
    <style>
      .navigation.nav-sticky .navbar-nav .nav-item .nav-link {
        color: #fff !important;
      }
    </style>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#topnav-menu" data-bs-offset="60">
    <!-- Header start -->
    <x-header-landing></x-header-landing>
    <!-- Header end -->
    
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
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
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
