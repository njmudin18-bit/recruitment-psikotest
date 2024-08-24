
<div class="vertical-menu">
  <div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu">Menu</li>
        <li class="{{ request()->routeIs('home') ? 'mm-active' : '' }}">
          <a href="{{ route('home') }}" class="waves-effect {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="bx bx-home-circle"></i>
            <span>Dashboards</span>
          </a>
        </li>

        @if (ShowHideMenu()->email_verified_at != null || ShowHideMenu()->email_verified_at != '')
          @foreach (getMenus() as $menu)
            @can('read ' . $menu->url)
              @if ($menu->type_menu == 'parent')
                <li class="{{ getParentMenus(request()->segment(1)) == $menu->name ? 'active open' : '' }}"> 
                  <a href="#" class="has-arrow waves-effect">
                    <i class="{{ $menu->icon }}"></i>
                    <span class="text-capitalize">{{ $menu->name }}</span>
                  </a>
                  <ul class="sub-menu {{ getParentMenus(request()->segment(1)) == $menu->name ? 'expand' : '' }}">
                    @foreach ($menu->subMenus as $submenu)
                      @can('read ' . $submenu->url)
                        <li class="{{ request()->segment(1) == explode('/', $submenu->url)[0] ? 'active' : '' }}">
                          <a href="{{ url($submenu->url) }}" class="link">
                            <span class="text-capitalize">
                              {{ $submenu->name }}
                            </span>
                          </a>
                        </li>
                      @endcan
                    @endforeach
                  </ul>
              </li>
              @elseif ($menu->type_menu == 'single')
                <li class="{{ request()->segment(1) == $menu->url ? 'mm-active' : '' }}">
                  <a href="{{ url($menu->url) }}" class="waves-effect {{ request()->segment(1) == $menu->url ? 'active' : '' }}">
                    <i class="{{ $menu->icon }}"></i>
                    <span class="text-capitalize">{{ $menu->name }}</span>
                  </a>
                </li>
              @endif
            @endcan
          @endforeach
        @endif
      </ul>
    </div>
    <!-- Sidebar -->
  </div>
</div>