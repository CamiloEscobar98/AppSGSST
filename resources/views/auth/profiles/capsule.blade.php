@extends('layouts.argon')
@section('title', 'Cápsula')
@section('content')
    @include('layouts.argon_nav_user_2')
    <div class="container-fluid mb-4 mt-5">
        <div class="card shadow">
            <div class="card-header bg-translucent-white"></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{ $capsule->video }}" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12 {{ checkColCapsule(session('role')) }} mt-4">
                    <div class="card shadow">
                        <div class="card-header bg-translucent-white">
                            <h2 class="mt-3 font-weight-bold">Información Cápsula</h2>
                        </div>
                        <div class="card-body">
                            @if (session('role') != 'capacitante')
                                <p class="card-text">Para actualizar la cápsula, llena las credenciales</p>
                            @endif
                            <form action="{{ route('capsule.update') }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="capsule" value="{{ $capsule->id }}">
                                <div class="form-group">
                                    <label for="title" class="font-weight-bold">Tiutlo</label>
                                    <input type="text" name="title" id="title"
                                        class="form-control text-capitalize @error('title') is-invalid @enderror"
                                        value="{{ $capsule->title }}" aria-describedby="helpId"
                                        {{ checkInput(session('role')) }}>
                                    @error('title')
                                        <small id="helpId"
                                            class="font-weight-bold bg-danger py-y text-white">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if (session('role') != 'capacitante')
                                    <div class="form-group">
                                        <label for="video" class="font-weight-bold">Video</label>
                                        <input type="text" name="video" id="video"
                                            class="form-control @error('video') is-invalid @enderror"
                                            value="{{ $capsule->video }}" aria-describedby="helpId"
                                            {{ checkInput(session('role')) }}>
                                        @error('video')
                                            <small id="helpId"
                                                class="font-weight-bold bg-danger py-y text-white">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="info" class="font-weight-bold">Descripción</label>
                                    <textarea class="form-control @error('info') is-invalid @enderror" name="info" id="info"
                                        rows="3" {{ checkInput(session('role')) }}>{{ $capsule->info }}</textarea>
                                    @error('info')
                                        <small id="helpId"
                                            class="font-weight-bold bg-danger py-y text-white">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if (session('role') != 'capacitante')
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-default">Actualizar</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                @if (session('role') != 'capacitante')
                    <div class="col-12 col-md-12 col-lg-12 col-xl-4 mt-4">
                        <div class="card shadow">
                            <div class="card-header bg-translucent-white">
                                <h2 class="font-weight-bold mt-3">Cambiar temática</h2>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('capsule.changeTopic') }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="capsule" value="{{ $capsule->id }}">
                                    <div class="form-group">
                                        <label for="topic" class="font-weight-bold">Temática</label>
                                        <select class="form-control" name="topic" id="topic">
                                            <option value="-1">Seleccione una temática</option>
                                            @foreach ($tematicas as $topic)
                                                @if ($topic->id == $capsule->topic->id)
                                                    <option value="{{ $topic->id }}" selected>{{ $topic->title }}
                                                    </option>
                                                @endif
                                                <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-default">Cambiar
                                            temática</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
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
