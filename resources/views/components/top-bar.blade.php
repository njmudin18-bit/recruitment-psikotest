<header id="page-topbar">
  <div class="navbar-header">
    <div class="d-flex">
      <!-- LOGO -->
      <div class="navbar-brand-box">
        <a href="{{ route('home') }}" class="logo logo-dark">
          <span class="logo-sm">
            <img src="{{ asset(config('appsproperties.APPS_ICON')) }}" alt="{{ config('appsproperties.COMPANY_NAME') }}" height="30">
          </span>
          <span class="logo-lg">
            <img src="{{ asset(config('appsproperties.APPS_LOGO')) }}" alt="{{ config('appsproperties.COMPANY_NAME') }}" height="auto" width="100%">
          </span>
        </a>

        <a href="{{ route('home') }}" class="logo logo-light">  
          <span class="logo-sm">
            <img src="{{ asset(config('appsproperties.APPS_ICON')) }}" alt="{{ config('appsproperties.COMPANY_NAME') }}" height="30">
          </span>
          <span class="logo-lg">
            <img src="{{ asset(config('appsproperties.APPS_LOGO')) }}" alt="{{ config('appsproperties.COMPANY_NAME') }}" height="auto" width="100%">
          </span>
        </a>
      </div>

      <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
      </button>

      <!-- App Search-->
      <form class="app-search d-none d-lg-block">
        <div class="position-relative">
          <input type="text" class="form-control" placeholder="Search...">
          <span class="bx bx-search-alt"></span>
        </div>
      </form>
    </div>

    <div class="d-flex">
      <div class="dropdown d-inline-block d-lg-none ms-2">
        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-magnify"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
          <form class="p-3">
            <div class="form-group m-0">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="dropdown d-none d-lg-inline-block ms-1">
        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bx bx-customize"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <div class="px-lg-2">
            <div class="row g-0">
              <div class="col">
                <a class="dropdown-icon-item" href="#">
                  <img src="{{ asset('assets/images/brands/github.png') }}" alt="Github">
                  <span>GitHub</span>
                </a>
              </div>
              <div class="col">
                <a class="dropdown-icon-item" href="#">
                  <img src="{{ asset('assets/images/brands/bitbucket.png') }}" alt="bitbucket">
                  <span>Bitbucket</span>
                </a>
              </div>
              <div class="col">
                <a class="dropdown-icon-item" href="#">
                  <img src="{{ asset('assets/images/brands/dribbble.png') }}" alt="dribbble">
                  <span>Dribbble</span>
                </a>
              </div>
            </div>

            <div class="row g-0">
              <div class="col">
                <a class="dropdown-icon-item" href="#">
                  <img src="{{ asset('assets/images/brands/dropbox.png') }}" alt="dropbox">
                  <span>Dropbox</span>
                </a>
              </div>
              <div class="col">
                <a class="dropdown-icon-item" href="#">
                  <img src="{{ asset('assets/images/brands/mail_chimp.png') }}" alt="mail_chimp">
                  <span>Mail Chimp</span>
                </a>
              </div>
              <div class="col">
                <a class="dropdown-icon-item" href="#">
                  <img src="{{ asset('assets/images/brands/slack.png') }}" alt="slack">
                  <span>Slack</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="dropdown d-none d-lg-inline-block ms-1">
        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
          <i class="bx bx-fullscreen"></i>
        </button>
      </div>

      <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if (getPhotoUser() == null)
            <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar.png') }}" alt="{{ ucfirst(Auth::user()->name) }}">
          @else
            <img class="rounded-circle header-profile-user" src="{{ url('/') }}/{{ getPhotoUser()->File }}" alt="{{ ucfirst(Auth::user()->name) }}">
          @endif
          
          <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ ucfirst(Auth::user()->name) }}</span>
          <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
          <!-- item-->
          <!-- <a class="dropdown-item" href="{{ route('users.profile') }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a> -->
          <!-- <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">My Wallet</span></a> -->
          <a class="dropdown-item d-block" href="{{ route('users.password') }}"><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Ganti password</span></a>
          <!-- <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a> -->
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> 
            <span key="t-logout">Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>

      <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
          <i class="bx bx-cog bx-spin"></i>
        </button>
      </div>
    </div>
  </div>
</header>