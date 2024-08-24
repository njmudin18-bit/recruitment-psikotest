<div>
  <nav class="navbar navbar-expand-lg navigation fixed-top sticky navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-logo" href="{{ url('/') }}">
        <img src="{{ asset(config('appsproperties.APPS_LOGO')) }}" alt="{{ config('appsproperties.COMPANY_NAME') }}" height="60" class="logo logo-dark">
        <img src="{{ asset(config('appsproperties.APPS_LOGO')) }}" alt="{{ config('appsproperties.COMPANY_NAME') }}" height="60" class="logo logo-light">
      </a>

      <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
        <i class="fa fa-fw fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="topnav-menu-content">
        <ul class="navbar-nav ms-auto text-white" id="topnav-menu" >
          <li class="nav-item">
            <a class="nav-link active" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item {{ Route::current()->getName() == 'home.faq' ? 'd-none' : '' }}">
            <a class="nav-link" href="#about">Tentang aplikasi</a>
          </li>
          <li class="nav-item {{ Route::current()->getName() == 'home.faq' ? 'd-none' : '' }}">
            <a class="nav-link" href="#faqs">Pertanyaan?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home.faq') }}">FAQ</a>
          </li>
        </ul>

        <div class="my-2 ms-lg-2">
          <a href="{{ route('login') }}" class="btn btn-success w-xs">Sign in</a>
          <a href="{{ route('register') }}" class="btn btn-danger w-xs">Daftar</a>
        </div>
      </div>
    </div>
  </nav>
</div>