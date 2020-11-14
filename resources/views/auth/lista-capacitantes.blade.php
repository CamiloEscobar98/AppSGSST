@extends('layouts.app')
@section('title', 'Capacitantes')
@section('content')
    <div class="container-fluid mb-4 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-sgsst2 py-4">
                        <h4 class="my-0 font-weight-bold">Registrar Capacitante</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-title">Por favor llena toda la información para registrar el capacitante.</p>
                        <form action="{{ route('user.create') }}" method="post">
                            @csrf
                            <input type="hidden" name="role" value="capacitante">
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
                                <label for="phone" class="font-weight-bold">Celular:</label>
                                <input type="text" name="phone" id="phone"
                                    class="form-control @error('phone') is-invalid @enderror" aria-describedby="helpId"
                                    maxlength="15"
                                    onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                @error('phone')
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
                                <label for="address" class="font-weight-bold">Dirección de residencia:</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address"
                                    id="address" rows="1"></textarea>
                                @error('address')
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
                        <h4 class="my-0 font-weight-bold">Lista de capacitantes</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-sgsst2 font-weight-bold text-center">
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Capacitante</th>
                                        <th>Correo electrónico</th>
                                        <th>Celular</th>
                                        <th>..</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($capacitantes as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->fullname() }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                <div class="btn-group w-100" role="group" aria-label="opciones">
                                                    <button type="button" class="btn btn-primary w-50">Ver</button>
                                                    <button type="button" class="btn btn-danger w-50">Borrar</button>
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
                                    <th>Capacitante</th>
                                    <th>Correo electrónico</th>
                                    <th>Celular</th>
                                    <th>..</th>
                                </tfoot>
                            </table>
                            {{ $capacitantes->links() }}
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
@endsection
