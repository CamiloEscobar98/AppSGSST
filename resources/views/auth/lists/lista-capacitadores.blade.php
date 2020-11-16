@extends('layouts.app')
@section('title', 'Capacitantes')
@section('content')
    <div class="container-fluid mb-4 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-sgsst2 py-4">
                        <h4 class="my-0 font-weight-bold">Registrar capacitador</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-title">Por favor llena toda la información para registrar el capacitador.</p>
                        <form action="{{ route('user.create') }}" method="post">
                            @csrf
                            <input type="hidden" name="role" value="capacitador">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Nombres:</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" aria-describedby="helpId">
                                @error('name')
                                    <small id="helpId"
                                        class="font-weight-bold text-white bg-danger py-2 px-2">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="font-weight-bold">Apellidos:</label>
                                <input type="text" name="lastname" id="lastname"
                                    class="form-control @error('lastname') is-invalid @enderror" aria-describedby="helpId">
                                @error('lastname')
                                    <small id="helpId"
                                        class="font-weight-bold text-white bg-danger py-2 px-2">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Correo electrónico:</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" aria-describedby="helpId">
                                @error('email')
                                    <small id="helpId"
                                        class="font-weight-bold text-white bg-danger py-2 px-2">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="document" class="font-weight-bold">Documento:</label>
                                <input type="text" name="document" id="document"
                                    class="form-control @error('document') is-invalid @enderror" aria-describedby="helpId"
                                    maxlength="15"
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
                                <button type="submit" class="btn btn-login btn-block">Registrar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-sgsst2 py-4"></div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-sgsst2 py-4">
                        <h4 class="my-0 font-weight-bold">Lista de capacitadores</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-sgsst2 font-weight-bold text-center">
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Capacitador</th>
                                        <th>Correo electrónico</th>
                                        <th>Documento</th>
                                        <th>..</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($capacitadores as $capacitador)
                                        <tr class="text-center" id="fila{{ $loop->iteration }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-capitalize">{{ $capacitador->fullname() }}</td>
                                            <td>{{ $capacitador->email }}</td>
                                            <td>{{ $capacitador->document->document }}</td>
                                            <td>
                                                <div class="btn-group w-100" role="group" aria-label="opciones">
                                                    <a href="{{ route('user.show', $capacitador) }}" type="button"
                                                        class="btn btn-primary w-50">Ver</a>
                                                    <button type="button" class="btn btn-danger w-50 delete-user"
                                                        data-user="{{ $capacitador->fullname() }}"
                                                        data-tr="{{ $loop->iteration }}"
                                                        data-email="{{ $capacitador->email }}">Borrar</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            No hay registros
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-sgsst2 font-weight-bold text-center">
                                    <th style="width: 5%">No</th>
                                    <th>Capacitador</th>
                                    <th>Correo electrónico</th>
                                    <th>Documento</th>
                                    <th>..</th>
                                </tfoot>
                            </table>
                            {{ $capacitadores->links() }}
                        </div>
                    </div>
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
            text: "¡El capacitador " + usuario.toUpperCase() + " Será eliminado!",
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
                }).then(response => {
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
