@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
    <section class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card shadow">
                    <div class="card-header bg-sgsst2 py-5">
                        <h1 class="font-weight-bold my-0 text-center text-capitalize">{{ session('role') }}</h1>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title float-right">Perfil de usuario</h4>
                        <p class="card-text">Actualiza tu información</p>
                        @include('layouts.user.update-form')
                    </div>
                    <div class="card-footer bg-sgsst2 py-4"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card shadow">
                            <div class="card-header bg-sgsst2 py-4">
                                <h4 class="my-0 font-weight-bold text-center">Cambiar contraseña</h4>
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
                                        <button type="submit" class="btn btn-login btn-block">Actualizar contraseña</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-sgsst2 py-4"></div>
                        </div>
                    </div>
                    @if (session('role') == 'administrador')
                        <div class="col-12 mt-4">
                            <div class="card shadow">
                                <div class="card-header bg-sgsst2 py-4">
                                    <h4 class="my-0 font-weight-bold text-center">Cambiar tipo de documento</h4>
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
                                                <small id="helpId" class="form-text text-white bg-danger font-weight-bold py-2 px-2">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-login btn-block">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer bg-sgsst2 py-4"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
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
