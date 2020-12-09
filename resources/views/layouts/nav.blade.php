<nav class="navbar navbar-expand-md navbar-light bg-white shadow">
    <div class="container-fluid">
        @guest
            <a class="navbar-brand" href="{{ url('/') }}">
                Página Principal
            </a>
        @else
            <a class="navbar-brand" href="{{ route('home') }}">
                Página Principal
            </a>
        @endguest
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @switch(session('role'))
                    @case('capacitante')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.topics') }}">Temáticas</a>
                    </li>
                    @break
                    @case('capacitador')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.my-topics') }}">Mis temáticas</a>
                    </li>
                    @break
                    @default
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Usuarios
                        </button>
                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <a class="dropdown-item" href="{{ route('capacitadores') }}">Capacitadores</a>
                            <a class="dropdown-item" href="{{ route('capacitantes') }}">Capacitantes</a>
                        </div>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tematicas') }}">Temáticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('capsulas') }}">Cápsulas</a>
                    </li>
                @endswitch

            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                                                                                                                             document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @if (count(Auth()->user()->roles) > 1)
                        <li class="nav-item">
                            <a href="" class="nav-link">Cambiar Rol</a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
