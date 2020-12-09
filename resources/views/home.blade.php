@extends('layouts.argon')
@section('title', 'Inicio')
@section('content')
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Navbar links -->
                <ul class="navbar-nav align-items-center  ml-md-auto ">
                    <li class="nav-item d-xl-none">
                        <!-- Sidenav toggler -->
                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                            data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>
                </ul>
                @include('layouts.argon_user_nav')
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="messages">
            @if (session()->has('update_complete'))
                <div class="alert alert-success" role="alert">
                    <strong>¡Éxito!</strong>{{ session('update_complete') }}
                </div>
            @endif
            @if (session()->has('update_failed'))
                <div class="alert alert-danger" role="alert">
                    <strong>¡Error!</strong>{{ session('update_failed') }}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-3 mt-5">
                <div class="card shadow">
                    <div class="card-header bg-primary py-5">
                        <h1 class="font-weight-bold my-0 text-center text-capitalize text-white">{{ session('role') }}</h1>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset(
                                Auth()->user()->image->fullimage(),
                            ) }}"
                            class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} mx-auto d-block"
                            alt="Foto de perfil" width="200vh">
                        <form action="{{ route('user.update-photo') }}" method="POST" class="mt-4"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="email" value="{{ Auth()->user()->email }}">
                            @method('patch')
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                        id="customFileLang" lang="en" name="image">
                                    <label class="custom-file-label" for="customFileLang"></label>
                                </div>
                                @error('image')
                                    <small id="helpId"
                                        class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Actualizar foto</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-primary py-4"></div>
                </div>
            </div>
            <div class="col-md-6 mt-5">
                <div class="card shadow">
                    <div class="card-header bg-primary py-5"></div>
                    <div class="card-body">
                        <h4 class="card-title float-right">Perfil de usuario</h4>
                        <p class="card-text">Actualiza tu información</p>
                        @include('layouts.user.update-form')
                    </div>
                    <div class="card-footer bg-primary py-4"></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card shadow">
                            <div class="card-header bg-primary py-4">
                                <h4 class="my-0 font-weight-bold text-center text-white">Cambiar contraseña</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.update-password') }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="email" value="{{ Auth()->user()->email }}">
                                    <div class="form-group">
                                        <label for="password" class="font-weight-bold text-capitalize">Nueva
                                            contraseña:</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            aria-describedby="helpId" placeholder="Escribe tu nombre.."
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <small id="helpId"
                                                class="form-text text-white bg-danger py-2 px-2 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Actualizar
                                            contraseña</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-primary py-4"></div>
                        </div>
                    </div>
                    @if (session('role') == 'administrador')
                        <div class="col-12 mt-4">
                            <div class="card shadow">
                                <div class="card-header bg-primary py-4">
                                    <h4 class="my-0 font-weight-bold text-center text-white">Cambiar tipo de documento</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('user.update-document') }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="email" value="{{ Auth()->user()->email }}">
                                        <div class="form-group">
                                            <label for="document_type_id" class="font-weight-bold text-capitalize">Tipo de
                                                documento:</label>
                                            <select name="document_type_id" id="document_type_id"
                                                class="custom-select text-capitalize" aria-describedby="helpId">
                                                <option value="-1" class="text-capitalize">Seleccione una opción</option>
                                                @foreach ($document_types as $document_type)
                                                    @if (Auth()->user()->document->document_type_id == $document_type->id)
                                                        <option class="text-capitalize" value="{{ $document_type->id }}"
                                                            selected>
                                                            {{ $document_type->info }}
                                                        </option>
                                                    @else
                                                        <option class="text-capitalize" value="{{ $document_type->id }}">
                                                            {{ $document_type->info }}
                                                        </option>
                                                    @endif

                                                @endforeach
                                            </select>
                                            @error('document_type_id')
                                                <small id="helpId"
                                                    class="form-text text-white bg-danger font-weight-bold py-2 px-2">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer bg-primary py-4"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.argon_footer')
    </div>
@endsection
@section('scripts')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>
@endsection
