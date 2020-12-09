@extends('layouts.argon')
@section('title', 'Capacitantes')
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
    <div class="container-fluid mb-4 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card shadow">
                            <div class="card-header bg-primary py-4">
                                <h4 class="my-0 font-weight-bold text-white">Registrar Capacitante</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-title">Por favor llena toda la información para registrar el capacitante.</p>
                                <form action="{{ route('user.create') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="role" value="capacitante">
                                    <div class="form-group">
                                        <label for="name" class="font-weight-bold">Nombres:</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" aria-describedby="helpId">
                                        @error('name')
                                            <small id="helpId"
                                                class="font-weight-bold text-white bg-danger py-2 px-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" class="font-weight-bold">Apellidos:</label>
                                        <input type="text" name="lastname" id="lastname"
                                            class="form-control @error('lastname') is-invalid @enderror"
                                            value="{{ old('lastname') }}" aria-describedby="helpId">
                                        @error('lastname')
                                            <small id="helpId"
                                                class="font-weight-bold text-white bg-danger py-2 px-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="font-weight-bold">Correo electrónico:</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" aria-describedby="helpId">
                                        @error('email')
                                            <small id="helpId"
                                                class="font-weight-bold text-white bg-danger py-2 px-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="document" class="font-weight-bold">Documento:</label>
                                        <input type="text" name="document" id="document"
                                            class="form-control @error('document') is-invalid @enderror"
                                            value="{{ old('document') }}" aria-describedby="helpId" maxlength="15"
                                            onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                        @error('document')
                                            <small id="helpId"
                                                class="font-weight-bold text-white bg-danger py-2 px-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="document" class="font-weight-bold">Tipo de documento:</label>
                                        <select name="document_type_id" id="document_type_id"
                                            class="custom-select text-capitalize @error('document_type_id') is-invalid @enderror">
                                            <option value="-1">Seleccione una opción</option>
                                            @foreach ($document_types as $document_type)
                                                <option value="{{ $document_type->type }}">{{ $document_type->info }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('document_type_id')
                                            <small id="helpId"
                                                class="font-weight-bold text-white bg-danger py-2 px-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-primary py-4"></div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="card shadow">
                            <div class="card-header py-4 bg-primary">
                                <h4 class="my-0 font-weight-bold">Cargar Capacitantes</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.massive') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('users') is-invalid @enderror"
                                                id="customFile" name="users">
                                            <label class="custom-file-label" for="customFile"></label>
                                        </div>
                                        @error('users')
                                            <small id="helpId"
                                                class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-primary">Subir</button>
                                    </div>
                                </form>
                                <div class="my-2">
                                    <a href="{{ asset('storage/users.xlsx') }}" class="btn btn-block btn-warning">Descargar
                                        formato</a>
                                </div>
                            </div>
                            <div class="card-footer bg-primary py-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-4">
                <div class="card shadow">
                    <div class="card-header bg-primary py-4">
                        <h4 class="my-0 font-weight-bold text-white">Lista de capacitantes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="bg-primary font-weight-bold text-center text-white">
                                    <tr>
                                        <th style="width: 5%">Foto</th>
                                        <th>Capacitante</th>
                                        <th>Correo electrónico</th>
                                        <th>Documento</th>
                                        <th>..</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($capacitantes as $capacitante)
                                        <tr class="text-center" id="fila{{ $loop->iteration }}">
                                            <td> <img src="{{ asset($capacitante->image->fullimage()) }}"
                                                    class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} mx-auto d-block"
                                                    alt="" width="50vh"></td>
                                            <td class="text-capitalize">{{ $capacitante->fullname() }}</td>
                                            <td>{{ $capacitante->email }}</td>
                                            <td>{{ $capacitante->document->document }}</td>
                                            <td>
                                                <div class="btn-group w-100" role="group" aria-label="opciones">
                                                    <a href="{{ route('user.show', $capacitante) }}" type="button"
                                                        class="btn btn-primary w-50"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></a>
                                                    <button type="button" class="btn btn-danger w-50 delete-user"
                                                        data-user="{{ $capacitante->fullname() }}"
                                                        data-tr="{{ $loop->iteration }}"
                                                        data-email="{{ $capacitante->email }}"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            No hay registros
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-primary font-weight-bold text-center text-white">
                                    <th style="width: 5%">No</th>
                                    <th>Capacitante</th>
                                    <th>Correo electrónico</th>
                                    <th>Documento</th>
                                    <th>..</th>
                                </tfoot>
                            </table>
                            {{ $capacitantes->links() }}
                        </div>
                    </div>
                    <div class="card-footer bg-primary py-4"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@if (session()->has('create_complete'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('create_complete') }}",
            showConfirmButton: false,
            timer: 1500
        })

    </script>
@endif
@if (session()->has('create_failed'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: "¡Error!",
            text: "{{ session('create_failed') }}",
            showConfirmButton: false,
            timer: 1500
        })

    </script>
@endif
<script>
    $('.delete-user').on('click', function() {
        var usuario = $(this).attr('data-user');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡El capacitante " + usuario.toUpperCase() + " Será eliminado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var usuario = $(this).attr('data-email');
                axios.post("{{ route('user.delete') }}", {
                    _method: 'delete',
                    usuario: usuario,
                }).then(res => {
                    console.log(res.data);
                    Swal.fire(
                        'Eliminación..',
                        res.data.message,
                        res.data.alert
                    )

                });
                var fila = $(this).attr('data-tr');
                $("#fila" + fila).remove();
                setTimeout(() => {
                    location.reload(true)
                }, 2000);
            }
        })
    });

</script>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script>
@endsection
