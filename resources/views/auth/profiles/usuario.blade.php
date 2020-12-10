@extends('layouts.argon')
@section('title', 'Perfil/Usuario')
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
    <section class="container-fluid mb-4">
        <div class="row justify-content-center">
            <div class="col-md-3 mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary py-5"></div>
                            <div class="card-body">
                                <img src="{{ asset($usuario->image->url . '/' . $usuario->image->image) }}"
                                    class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} mx-auto d-block"
                                    alt="Foto de perfil" width="200vh">
                                <form action="{{ route('user.update-photo') }}" method="POST" class="mt-4"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $usuario->email }}">
                                    @method('patch')
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                id="customFile" name="image">
                                            <label class="custom-file-label" for="customFile"></label>
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
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-primary py-4 text-center">
                                <h4 class="font-weight-bold my-0 text-white">Asignar rol de Usuario</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.addRole') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $usuario->email }}">
                                    <div class="form-group">
                                        <label for="role" class="font-weight-bold">Rol de Usuario</label>
                                        <select name="role" id="role"
                                            class="custom-select @error('role') is-invalid @enderror">
                                            <option value="-1">Seleccione una opción</option>
                                            @foreach ($roles->except(1) as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <small id="helpId"
                                                class="form-text text-white bg-danger py-2 px-2 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-primary">Agregar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-primary py-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-5">
                <div class="card shadow">
                    <div class="card-header bg-primary py-5"></div>
                    <div class="card-body">
                        <h4 class="card-title float-right">Perfil de usuario</h4>
                        <p class="card-text">Actualiza tu información</p>
                        @include('layouts.user.update-form-2')
                        <hr class="bg-primary my-4">
                        <h4 class="font-weight-bold">Roles Asignados</h4>
                        <ul class="list-group">
                            @forelse ($usuario->roles as $role)
                                <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm"
                                    id="fila{{ $loop->iteration }}">
                                    <p class="my-0 text-capitalize"> {{ $role->name }}</p>
                                    <button type="button" class="btn btn-danger delete-role" data-tr="{{ $loop->iteration }}"
                                        data-role="{{ $role->name }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </li>
                            @empty
                                <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm">
                                    Ningún rol asignado
                                </li>
                            @endforelse

                        </ul>
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
                                    <input type="hidden" name="email" value="{{ $usuario->email }}">
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
                                        <input type="hidden" name="email" value="{{ $usuario->email }}">
                                        <div class="form-group">
                                            <label for="document_type_id" class="font-weight-bold text-capitalize">Tipo de
                                                documento:</label>
                                            <select name="document_type_id" id="document_type_id"
                                                class="custom-select text-capitalize" aria-describedby="helpId">
                                                <option value="-1" class="text-capitalize">Seleccione una opción</option>
                                                @foreach ($document_types as $document_type)
                                                    @if ($usuario->document->document_type_id == $document_type->id)
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
    </section>
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
<script>
    $('.delete-role').on('click', function() {
        var role = $(this).attr('data-role');
        var usuario = "{{ $usuario->email }}";
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡El rol " + role.toUpperCase() + " Será eliminado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post("{{ route('user.deleteRole') }}", {
                    _method: 'delete',
                    usuario: usuario,
                    role: role
                }).then(response => {
                    console.log(response.data);
                    Swal.fire(
                        'Eliminado!',
                        response.data,
                        'success'
                    )

                });
                var fila = $(this).attr('data-tr');
                $("#fila" + fila).remove();
            }
        })
    });

</script>
@endsection
