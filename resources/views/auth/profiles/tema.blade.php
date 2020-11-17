@extends('layouts.app')
@section('title', 'Temática')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header bg-sgsst2 py-4">
                                <h4 class="my-0 font-weight-bold">Temática</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Actualizar la información de la temática.</p>
                                <form action="{{ route('topic.update') }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="topic" value="{{ $tema->id }}">
                                    <div class="form-group">
                                        <label for="title" class="font-weight-bold">Título:</label>
                                        <input type="text" name="title" id="title" value="{{ $tema->title }}"
                                            class="form-control @error('title') is-invalid @enderror" placeholder=""
                                            aria-describedby="helpId">
                                        @error('title')
                                            <small id="helpId"
                                                class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="info" class="font-weight-bold">Descripción:</label>
                                        <textarea class="form-control @error('info') is-invalid @enderror" name="info"
                                            id="info" aria-describedby="helpId" rows="3">{{ $tema->info }}</textarea>
                                        @error('info')
                                            <small id="helpId"
                                                class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-login">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-sgsst2 py-4"></div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-sgsst2 py-4">
                                <h4 class="text-white font-weight-bold my-0">Cambiar Capacitador</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('topic.update-capacitante') }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="topic" value="{{ $tema->id }}">
                                    <div class="form-group">
                                        <label for="capacitador" class="font-weight-bold">Capacitador:</label>
                                        <select class="form-control @error('capacitador') is-invalid @enderror"
                                            name="capacitador" id="capacitador">
                                            <option value="-1">Seleccione un capacitador</option>
                                            @foreach ($capacitadores as $capacitador)
                                                @if ($capacitador->email == $tema->user->email)
                                                    <option value="{{ $capacitador->email }}" selected>
                                                        {{ $capacitador->fullname() }}
                                                    </option>
                                                @endif
                                                <option value="{{ $capacitador->email }}">{{ $capacitador->fullname() }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('capacitador')
                                            <small id="helpId" class="text-white bg-danger py-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-login">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-sgsst2 py-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-5"></div>
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
