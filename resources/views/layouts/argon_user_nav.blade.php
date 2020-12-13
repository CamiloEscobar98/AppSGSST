<ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
    <li class="nav-item dropdown">
        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{ asset(
                        Auth()->user()->image->fullimage(),
                    ) }}">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold text-capitalize">{{ Auth()->user()->fullname() }}</span>
                </div>
            </div>
        </a>
        <div class="dropdown-menu  dropdown-menu-right ">
            <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">¡Bienvenido!</h6>
                <h3>{{ session('role') }}</h3>
            </div>
            <a class="dropdown-item" href="{{ route('home') }}">
                <i class="ni ni-single-02"></i>
                <span>Perfil</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i>
                <span>Cerrar Sesión</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
</ul>
