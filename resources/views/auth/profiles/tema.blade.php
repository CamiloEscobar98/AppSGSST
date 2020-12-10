@extends('layouts.argon')
@section('title', 'Temática')
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
        <div class="row">
            <div class="col-md-4 mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header bg-primary pt">
                                <h4 class="my-0 font-weight-bold text-white">Temática</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-title font-weight-bold">Capacitador</p>
                                <p class="card-text">{{ $tema->user->fullname() }}</p>
                                <p class="card-text">Actualizar la información de la temática.</p>
                                <img src="{{ asset($tema->image->fullimage()) }}"
                                    class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} mx-auto d-block"
                                    alt="" width="200vh">
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
                                        <button type="submit" class="btn btn-block btn-primary">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-primary py-4"></div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 mb-4">
                        <div class="row">
                            @if (session('role') == 'administrador')
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-primary py-4">
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
                                                            @else
                                                                <option value="{{ $capacitador->email }}">
                                                                    {{ $capacitador->fullname() }}
                                                                </option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                    @error('capacitador')
                                                        <small id="helpId"
                                                            class="text-white bg-danger py-1">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit"
                                                        class="btn btn-block btn-primary">Actualizar</button>
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
            </div>
            <div class="col-md-8 mt-4">
                @if ($tema->game == null)
                    <div class="card">
                        <div class="card-header bg-primary py-4"></div>
                        <div class="card-body">
                            <form action="{{ route('game.create') }}" method="post">
                                @csrf
                                <input type="hidden" name="topic" value="{{ $tema->id }}">
                                <div class="form-group">
                                    <label for="title_game" class="font-weight-bold">Titulo del Juego</label>
                                    <input type="text" name="title_game" id="title_game" value="{{ old('title_game') }}"
                                        class="form-control @error('title_game') is-invalid @enderror"
                                        placeholder="Titulo del juego" aria-describedby="helpId">
                                    @error('title_game')
                                        <small id="helpId"
                                            class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="game_type" class="font-weight-bold">Tipo de juego</label>
                                    <select class="custom-select @error('game_type') is-invalid @enderror" name="game_type"
                                        id="game_type">
                                        <option value="-1" selected>Seleccione un tipo de juego</option>
                                        <option value="1">Ahorcado</option>
                                        <option value="2">Sopa de Letras</option>
                                    </select>
                                    @error('game_type')
                                        <small id="helpId"
                                            class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary">Registrar juego</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer bg-primary py-4"></div>
                    </div>
                @else
                    @if ($tema->game->gameable->words()->count() != null)
                        <button class="btn btn-block btn-primary"
                            onclick="mostrar_ocultar_juego('play_game')">Jugar</button>
                        <a href="{{ route('game.show', $tema->game) }}" class="btn btn-block btn-primary">Ver
                            juego</a>
                        <button type="button" class="btn btn-block btn-danger delete-game"
                            data-game="{{ $tema->game->id }}">Eliminar</button>

                    @else
                        <a href="{{ route('game.show', $tema->game) }}" class="btn btn-block btn-primary">Ver
                            juego</a>
                        <button type="button" class="btn btn-block btn-danger delete-game"
                            data-game="{{ $tema->game->id }}">Eliminar</button>
                    @endif
                    <div id="play_game">
                        @if ($tema->game->type == 1)
                            @include('auth.games.hangman')
                        @endif
                        @if ($tema->game->type == 2)
                            @include('auth.games.wordfind')
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        mostrar_ocultar_juego('play_game')
        $('.delete-capsule').on('click', function() {
            var capsule = $(this).attr('data-title');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡La cápsula " + capsule.toUpperCase() + " Será eliminado!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, eliminalo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var capsule = $(this).attr('data-capsule');
                    axios.post("{{ route('capsule.delete') }}", {
                        _method: 'delete',
                        capsule: capsule,
                    }).then(res => {
                        var titulo = (res.data.alert == 'success') ? '¡Eliminado!' : '¡Error';
                        Swal.fire(
                            titulo,
                            res.data.message,
                            res.data.alert
                        )

                    });
                    var fila = $(this).attr('data-tr');
                    $("#fila" + fila).remove();
                }
            })
        });

        function mostrar_ocultar_juego(id) {
            var play_game = document.getElementById(id);
            play_game.style.display = (play_game.style.display == 'none') ? 'block' : 'none';
        }

    </script>
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
        $('.delete-game').on('click', function() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Se eliminará el juego..",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, eliminalo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var game = $(this).attr('data-game');
                    axios.post("{{ route('game.delete') }}", {
                        _method: 'delete',
                        game: game,
                    }).then(res => {
                        var titulo = (res.data.alert == 'success') ? '¡Eliminado!' : '¡Error';
                        Swal.fire(
                            titulo,
                            res.data.message,
                            res.data.alert
                        )
                        setTimeout(() => {
                            location.reload(true)
                        }, 2000);

                    });
                }
            })
        });

    </script>
@endsection
