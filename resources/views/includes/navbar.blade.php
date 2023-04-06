<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}"><img src="{{ url('logo_si.svg') }}" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img src="{{ url('logo_si_mini.svg') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                    aria-expanded="false">
                    <div class="nav-profile-img">
                        @if (Auth::user()->avatar != NULL)
                            <img src="{{ url('images/avatar/' . Auth::user()->avatar) }}" alt="image">
                        @else
                            <img src="{{ url('avatar.png') }}" alt="image">
                        @endif

                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{ Auth::user()->nama }}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                    aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                    <div class="p-3 text-center bg-primary" style="background-color: #256D85 !important;">
                        @if (Auth::user()->avatar != NULL)
                            <img class="img-avatar img-avatar48 img-avatar-thumb"  src="{{ url('images/avatar/' . Auth::user()->avatar) }}" alt="image">
                        @else
                        <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ url('avatar.png') }}" alt="">
                        @endif

                    </div>
                    <div class="p-2">
                        <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>
                        <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                            href="{{ route('profile.edit') }}">
                            <span>Show Profile</span>
                            <i class="mdi mdi-account-box ml-1"></i>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                            href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <span>Log Out</span>
                                <i class="mdi mdi-logout ml-1"></i>
                            </a>
                        </form>

                    </div>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
