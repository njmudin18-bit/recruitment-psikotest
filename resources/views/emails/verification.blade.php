<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>{{ $SubTitle }} | {{ config('appsproperties.APPS_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="{{ $SubTitle }} | {{ config('appsproperties.APPS_NAME') }}">
		<meta name="description" content="{{ config('appsproperties.APPS_DESCRIPTION') }}">
		<meta name="keywords" content="{{ config('appsproperties.APPS_KEYWORD') }}">
		<meta name="subject" content="{{ config('appsproperties.APPS_NAME') }}">
		<meta name="language" content="ID">
		<meta name="author" content="{{ config('appsproperties.APPS_AUTHOR') }}">
		<meta name="designer" content="{{ config('appsproperties.APPS_AUTHOR') }}">
		<meta name="copyright" content="{{ config('appsproperties.APPS_COPYRIGHT') }}">
		<meta name="robots" content="index, follow" />
		<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
		<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(config('appsproperties.APPS_ICON')) }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="account-pages my-3 pt-sm-3">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center mb-5 text-muted">
              <a href="index.html" class="d-block auth-logo">
                <img src="{{ asset(config('appsproperties.APPS_ICON')) }}" alt="{{ config('appsproperties.APPS_NAME') }}" height="64" class="auth-logo-dark mx-auto">
                <img src="{{ asset(config('appsproperties.APPS_ICON')) }}" alt="{{ config('appsproperties.APPS_NAME') }}" height="64" class="auth-logo-light mx-auto">
              </a>
              <p class="mt-3">{{ config('appsproperties.APPS_NAME') }} <strong>{{ strtoupper(config('appsproperties.COMPANY_NAME')) }}</strong></p>
            </div>
          </div>
        </div>
        <!-- end row -->
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">
              <div class="card-body"> 
                <div class="p-2">
                  <div class="text-center">
                    <div class="avatar-md mx-auto">
                      <div class="avatar-title rounded-circle bg-light">
                        <i class="bx bx-mail-send h1 mb-0 text-primary"></i>
                      </div>
                    </div>
                    <div class="p-2 mt-4">
                      <h4>{{ $VerificationMessage }}</h4>
                      <p class="text-muted">{!! $SubverificationMessage !!}</p>
                      <div class="mt-4">
                        {!! $Button !!}
                        <!-- <a href="{{ route('login') }}" class="btn btn-success">Log in</a> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-5 text-center">
              <p>{{ config('appsproperties.APPS_COPYRIGHT') }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
  </body>
</html>
