@extends('layouts.app')
@section('title', 'Iniciar Sesión')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-sgsst2 py-5"></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="card-title">
                                <p class="font-weight-bold text-right">Por favor, llenar todas las credenciales para poder
                                    iniciar sesión.</p>
                            </div>
                            <div class="form-group my-3">
                                <label for="email" class="font-weight-bolder">
                                    Correo Electrónico:
                                </label>
                                <input id="email" type="email"
                                    class="form-control my-2 @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="font-weight-bolder">
                                    Contraseña:
                                </label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role"
                                    class="font-weight-bolder @error('role_id') is-invalid @enderror">Seleccione el tipo de
                                    usuario:</label>
                                <select name=" role_id" class="custom-select text-capitalize">
                                    <option value="1">Seleccione un tipo de usuario</option>
                                    @foreach ($roles->except(1) as $role)
                                        <option value="{{ $role->id }}" class="text-capitalize">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="btn-group w-100">
                                    <button type="submit" class="btn btn-login">
                                        Iniciar Sesión
                                    </button>

                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-login2" href="{{ route('password.request') }}">
                                            ¿Olvidaste tu contraseña?
                                        </a>
                                    @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-sgsst2 py-4"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
