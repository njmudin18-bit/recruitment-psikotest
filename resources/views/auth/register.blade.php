<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Register | {{ config('appsproperties.APPS_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Register | {{ config('appsproperties.APPS_NAME') }}">
		<meta name="description" content="{{ config('appsproperties.APPS_DESCRIPTION') }}">
		<meta name="keywords" content="{{ config('appsproperties.APPS_KEYWORD') }}">
		<meta name="subject" content="{{ config('appsproperties.APPS_NAME') }}">
		<meta name="language" content="ID">
		<meta name="author" content="{{ config('appsproperties.APPS_AUTHOR') }}">
		<meta name="designer" content="{{ config('appsproperties.APPS_AUTHOR') }}">
		<meta name="copyright" content="{{ config('appsproperties.APPS_COPYRIGHT') }}">
		<meta name="url" content="{{ route('register') }}">
		<meta name="identifier-URL" content="{{ route('register') }}">
		<meta name="robots" content="index, follow" />
		<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
		<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
		<link rel="canonical" href="{{ route('register') }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(config('appsproperties.APPS_ICON')) }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <style>
      body {
        background-image: url('assets/images/bg-login.png');
        background-repeat: no-repeat;
        background-attachment: fixed; 
        background-size: 100% 100%;
      }

      /* .was-validated .invalid-feedback {
        display: block;
      } */
    </style>
  </head>
  <body>
    <div class="account-pages my-5 pt-sm-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
              <div class="bg-primary bg-soft">
                <div class="row">
                  <div class="col-7">
                    <div class="text-primary p-4">
                      <h5 class="text-primary">Register</h5>
                      <p>Daftarkan diri anda dengan melengkapi data diri anda.</p>
                    </div>
                  </div>
                  <div class="col-5 align-self-end">
                    <img src="{{ asset('assets/images/profile-img.png') }}" alt="{{ config('appsproperties.APPS_NAME') }}" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-body pt-0"> 
                <div>
                  <a href="#">
                    <div class="avatar-md profile-user-wid mb-4">
                      <span class="avatar-title rounded-circle bg-light">
                        <img src="{{ asset(config('appsproperties.APPS_ICON')) }}" alt="{{ config('appsproperties.APPS_NAME') }}" class="rounded-circle" height="64">
                      </span>
                    </div>
                  </a>
                </div>
                <div class="p-2">
                  <!-- <form class="needs-validation" novalidate action="#"> -->
                  <!-- <form action="{{ route('register') }}" method="POST" class="needs-validation" novalidate> -->
                  <form id="register_form" class="needs-validation" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                      <label for="username" class="form-label">Nama</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" @required(true) autocomplete="name" autofocus placeholder="Nama anda">
                      <div class="invalid-feedback">
                        Please enter name
                      </div>
                      
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="mb-3">
                      <label for="useremail" class="form-label">Email</label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" @required(true) autocomplete="email" placeholder="Email anda">
                      <div class="invalid-feedback">
                        Please enter email
                      </div>   
                      
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    
                    <div class="mb-3">
                      <label for="username" class="form-label">Password</label>
                      <input id="password" type="password" class="form-control rounded show-password @error('password') is-invalid @enderror"
                        placeholder="Password anda" name="password" @required(true) autocomplete="new-password">
                      <div class="invalid-feedback">
                        Please enter password
                      </div>

                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div> 
                  
                    <div class="mb-3">
                      <label for="userpassword" class="form-label">Confirm Password</label>
                      <input id="password-confirm" type="password" class="form-control show-password" placeholder="Confirm password anda" 
                        name="password_confirmation" @required(true) autocomplete="new-password">
                      <div class="invalid-feedback">
                        Please enter confirm password
                      </div>       
                    </div>

                    <div class="mb-3">
                      <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" class="form-control" @required(true)></div>
                      
                      @error('g-recaptcha-response')
                      <div class="invalid-feedback">
                        Please check the Captcha
                      </div>
                      @endif
                    </div>

                    <div class="mt-4 d-grid">
                      <button id="button_login" class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
                    </div>

                    <div class="mt-4 text-center">
                      <p class="mb-0">Dengan mendaftar, anda menyetujui ketentuan pengguna di <a href="#" class="text-primary">{{ config('appsproperties.APPS_NAME') }}</a>.</p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="mt-5 text-center text-white">
              <div>
                <p>Sudah memiliki akun? <a href="{{ route('login') }}" class="fw-medium text-white"> Login</a> </p>
                <p>{{ config('appsproperties.APPS_COPYRIGHT') }}</p>
              </div>
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

    <!-- validation init -->
    <script src="{{ asset('assets/js/pages/validation.init.js') }}"></script>
    
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
			$(function () {
				$.validator.setDefaults({
					submitHandler: loginAction
				});
				$('#register_form').validate({
					rules: {
            name: {
							required: true,
							minlength: 4,
						},
						email: {
							required: true,
              email: true,
							minlength: 4,
						},
						password: {
							required: true,
							minlength: 8
						}
					},
					errorElement: 'span',
					errorPlacement: function (error, element) {
						error.addClass('invalid-feedback');
						element.closest('.form-group').append(error);
					},
					highlight: function (element, errorClass, validClass) {
						$(element).addClass('is-invalid');
					},
					unhighlight: function (element, errorClass, validClass) {
						$(element).removeClass('is-invalid');
					}
				});

				function loginAction() {
          var MyEmail = $("#email").val();
					var data    = $("#register_form").serialize();
					$.ajax({
						type: "POST",
						url: "{{ route('register') }}",
						data: data,
						beforeSend: function () {
							$("#error").fadeOut();
							$("#button_login").prop('disabled', true);
							$("#button_login").html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...');
						},
						success: function (response) {
              grecaptcha.reset();
              //$("#register_form")[0].reset();
              $("#button_login").prop('disabled', false);
							$("#button_login").html('Register');

              Swal.fire({
                title: "Sukses!",
                text: "Harap periksa akun email " + MyEmail + " anda dan klik tombol verifikasi email anda.",
                icon: "success"
              });
						}, 
            error: function (xhr, status, errorThrown) {
              if (xhr.status == 422 && xhr.responseJSON.message == 'The g-recaptcha-response field is required.') {
                Swal.fire({
                  title: "Oops...",
                  text: "Harap ceklis I'm not a robot",
                  icon: "info"
                });
              } else if (xhr.status == 422) {
                Swal.fire({
                  title: "Oops...",
                  text: xhr.responseJSON.message,
                  icon: "info"
                });
              } else {
                Swal.fire({
                  title: "Oops...",
                  text: errorThrown,
                  icon: "info"
                });
              }

              grecaptcha.reset();
              $("#button_login").prop('disabled', false);
							$("#button_login").html('Register');
            }
					});
					return false;
				}
			});
		</script>
  </body>
</html>
