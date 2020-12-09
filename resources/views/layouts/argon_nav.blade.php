<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="{{ route('home') }}">
                ¡Bienvenido!
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    @switch(session('role'))
                        @case('capacitante')
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('user.topics') }}">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Mis Temáticas</span>
                            </a>
                        </li>
                        @break
                        @case('capacitador')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.my-topics') }}">Mis temáticas</a>
                        </li>
                        @break
                        @default
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('capacitadores') }}">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span class="nav-link-text">Lista de Capacitadores</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('capacitantes') }}">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <span class="nav-link-text">Lista de Capacitantes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tematicas') }}">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Lista de Temáticas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('capsulas') }}">
                                <i class="ni ni-air-baloon"></i>
                                <span class="nav-link-text">Lista de Cápsulas</span>
                            </a>
                        </li>
                    @endswitch

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="examples/icons.html">
                            <i class="ni ni-planet text-orange"></i>
                            <span class="nav-link-text">Icons</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="examples/map.html">
                            <i class="ni ni-pin-3 text-primary"></i>
                            <span class="nav-link-text">Google</span>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="examples/profile.html">
                            <i class="ni ni-single-02 text-yellow"></i>
                            <span class="nav-link-text">Inicio</span>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="examples/tables.html">
                            <i class="ni ni-bullet-list-67 text-default"></i>
                            <span class="nav-link-text">Tables</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="examples/login.html">
                            <i class="ni ni-key-25 text-info"></i>
                            <span class="nav-link-text">Login</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="examples/register.html">
                            <i class="ni ni-circle-08 text-pink"></i>
                            <span class="nav-link-text">Register</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="examples/upgrade.html">
                            <i class="ni ni-send text-dark"></i>
                            <span class="nav-link-text">Upgrade</span>
                        </a>
                    </li> --}}
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                {{-- <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Documentation</span>
                </h6> --}}
                <!-- Navigation -->
                {{-- <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html"
                            target="_blank">
                            <i class="ni ni-spaceship"></i>
                            <span class="nav-link-text">Getting started</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html"
                            target="_blank">
                            <i class="ni ni-palette"></i>
                            <span class="nav-link-text">Foundation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html"
                            target="_blank">
                            <i class="ni ni-ui-04"></i>
                            <span class="nav-link-text">Components</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="https://demos.creative-tim.com/argon-dashboard/docs/plugins/charts.html"
                            target="_blank">
                            <i class="ni ni-chart-pie-35"></i>
                            <span class="nav-link-text">Plugins</span>
                        </a>
                    </li>
                </ul> --}}
            </div>
        </div>
    </div>
</nav>
