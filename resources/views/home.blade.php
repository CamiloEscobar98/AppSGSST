@extends('layouts.argon')
@section('title', 'Inicio')
@section('content')
    @include('layouts.argon_nav_user_2')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-4 mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header bg-translucent-white">
                                <h2 class="my-0 font-weight-bold mt-3">Cambiar contraseña</h2>
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
                                        <button type="submit" class="btn btn-outline-danger btn-block">Actualizar
                                            contraseña</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @if (session('role') == 'administrador')
                            <div class="card shadow">
                                <div class="card-header bg-translucent-white">
                                    <h2 class="my-0 font-weight-bold mt-3">Cambiar tipo de documento
                                    </h2>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('user.update-document') }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="email" value="{{ Auth()->user()->email }}">
                                        <div class="form-group">
                                            <label for="document_type_id" class="font-weight-bold text-capitalize">Tipo
                                                de
                                                documento:</label>
                                            <select name="document_type_id" id="document_type_id"
                                                class="custom-select text-capitalize" aria-describedby="helpId">
                                                <option value="-1" class="text-capitalize">Seleccione una opción
                                                </option>
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
                                            <button type="submit"
                                                class="btn btn-outline-default btn-block">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-12 col-lg-12 col-xl-4 mt-5">
                <div class="card shadow">
                    <div class="card-header bg-translucent-white">
                        <h2 class="font-weight-bold mt-3">Actualiza tu información</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Perfil de usuario</h4>
                        @include('layouts.user.update-form')
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-4">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card shadow">
                            <div class="card-header bg-translucent-white">
                                <h2 class="font-weight-bold text-capitalize mt-3">

                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="font-weight-bold">Rol en sesión:</h3>
                                </div>
                                <p class="card-text text-capitalize font-weight-bold"> {{ session('role') }}</p>
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
                                            <input type="file"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                id="customFileLang" name="image">
                                            <label class="custom-file-label" for="customFile"></label>
                                        </div>
                                        @error('image')
                                            <small id="helpId"
                                                class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-default btn-block">Actualizar
                                            foto</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

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
    @if (session()->has('update_complete'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('update_complete') }}",
                showConfirmButton: false,
                timer: 1500
            })

        </script>
    @endif
    @if (session()->has('update_failed'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "¡Error!",
                text: "{{ session('update_failed') }}",
                showConfirmButton: false,
                timer: 1500
            })

        </script>
    @endif
@endsection
