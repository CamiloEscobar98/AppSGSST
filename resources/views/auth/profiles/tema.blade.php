@extends('layouts.argon')
@section('title', 'Temática')
@section('content')
    @include('layouts.argon_nav_user_2')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 {{ checkColTopic(session('role')) }} mt-4">
                <div class="card shadow">
                    <div class="card-header bg-translucent">
                        <h2 class="my-0 font-weight-bold mt-3">Perfil Tema</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <img src="{{ asset($tema->image->fullimage()) }}" class="img-fluid mx-auto d-block" alt=""
                                    width="200vh">
                            </div>
                            <div class="col-12 col-md-7">

                                @if (session('role') != 'capacitante')
                                    <h3 class="card-title font-weight-bold">Capacitador</h3>
                                    @if ($tema->user)
                                        <a href="{{ route('user.show', $tema->user) }}">
                                            <p class="card-text font-weight-bold">{{ $tema->user->fullname() }}</p>
                                        </a>
                                    @else
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-8">
                                                <p class="px-2 bg-danger text-white font-weight-bold text-center">No tiene
                                                    encargado asignado.</p>
                                            </div>
                                        </div>
                                    @endif
                                    <p class="card-text font-weight-bold">Actualizar la información de la temática.</p>
                                @endif
                                <form action="{{ route('topic.update') }}" method="post" class="mt-4">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="title" class="font-weight-bold">Título:</label>
                                        <input type="text" name="title" id="title" value="{{ $tema->title }}"
                                            class="form-control @error('title') is-invalid @enderror"
                                            {{ checkInput(session('role')) }} aria-describedby="helpId">
                                        @error('title')
                                            <small id="helpId"
                                                class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="info" class="font-weight-bold">Descripción:</label>
                                        <textarea class="form-control @error('info') is-invalid @enderror" name="info"
                                            id="info" aria-describedby="helpId" rows="3"
                                            {{ checkInput(session('role')) }}>{{ $tema->info }}</textarea>
                                        @error('info')
                                            <small id="helpId"
                                                class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="topic" value="{{ $tema->id }}">


                                    @if (session('role') != 'capacitante')
                                        <div class="form-group float-left">
                                            <button type="submit"
                                                class="btn btn-block btn-outline-primary">Actualizar</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-translucent-white">
                        <h2 class="mt-3 font-weight-bold">Cápsulas</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Todas las cápsulas disponibles</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="w-25 bg-translucent-default text-white font-weight-bold">Titulo</th>
                                        <th class="w-50 bg-translucent-white font-weight-bold text-white">Descripción</th>
                                        <th class="bg-translucent-default text-white font-weight-bold" style="width: 5%">..
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($capsules as $capsula)
                                        <tr>
                                            <td>{{ $capsula->title }}</td>
                                            <td>{{ $capsula->info }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('capsule.show', $capsula) }}" type="button"
                                                        class="btn btn-outline-primary mr-2"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></a>
                                                    @if (session('role') != 'capacitante')
                                                        <button type="button" class="btn btn-outline-danger  delete-capsule"
                                                            data-tr="{{ $loop->iteration }}" data-title="{{ $capsula->title }}"
                                                            data-capsule="{{ $capsula->id }}"><i class="fa fa-trash"
                                                                aria-hidden="true"></i></button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <h4>No tiene cápsulas registradas.</h4>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('role') == 'administrador')
                <div class="col-12 col-md-5 mt-4">
                    <div class="card shadow">
                        <div class="card-header bg-translucent-white">
                            @if ($tema->user)
                                <h2 class="font-weight-bold mt-3">Cambiar Capacitador</h2>
                            @else
                                <h2 class="font-weight-bold mt-3">Asignar Capacitador</h2>
                            @endif
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

                                            <option value="{{ $capacitador->email }}">
                                                {{ $capacitador->fullname() }}
                                            </option>

                                        @endforeach
                                    </select>
                                    @error('capacitador')
                                        <small id="helpId" class="text-white bg-danger py-1">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group float-left">
                                    <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if (session('role') != 'capacitante')
            <div class="card shadow">
                <div class="card-header bg-translucent-white">
                    <h2 class="font-weight-bold mt-3">Progreso de Capacitantes</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-inverse table-bordered">
                            <thead class="bg-primary font-weight-bold text-center text-white">
                                <tr>
                                    <th class="bg-translucent-white w-75">Capacitante</th>
                                    <th class="bg-translucent-default text-white w-25">Completado</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($myusers as $item)
                                    <tr>
                                        <td>{{ $item->fullname() }}</td>
                                        <td>
                                            {!! returnCompleted($item->pivot->completed) !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>No hay registros</tr>
        @endforelse

        </tbody>
        </table>
    </div>
    </div>
    </div>
    @endif

    @if ($tema->game == null)
        @if (session('role') != 'capacitante')
            <div class="card shadow">
                <div class="card-header bg-translucent-white">
                    <h2 class="font-weight-bold mt-3">Registrar Actividad Interactiva</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('game.create') }}" method="post">
                        @csrf
                        <input type="hidden" name="topic" value="{{ $tema->id }}">
                        <div class="form-group">
                            <label for="title_game" class="font-weight-bold">Titulo</label>
                            <input type="text" name="title_game" id="title_game" value="{{ old('title_game') }}"
                                class="form-control @error('title_game') is-invalid @enderror" placeholder="Titulo"
                                aria-describedby="helpId">
                            @error('title_game')
                                <small id="helpId" class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="game_type" class="font-weight-bold">Tipo</label>
                            <select class="custom-select @error('game_type') is-invalid @enderror" name="game_type"
                                id="game_type">
                                <option value="-1" selected>Seleccione el tipo de actividad</option>
                                <option value="1">Ahorcado</option>
                                <option value="2">Sopa de Letras</option>
                            </select>
                            @error('game_type')
                                <small id="helpId" class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-outline-primary">Registrar juego</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-danger container text-center w-auto" role="alert">
                <strong>No hay registrado una actividad interactiva</strong>
            </div>
        @endif
    @else
        @if ($tema->game->gameable->words()->count() != null)
            <button class="btn btn-outline-primary" onclick="mostrar_ocultar_juego('play_game')">Jugar</button>

            @if (session('role') != 'capacitante')
                <a href="{{ route('game.show', $tema->game) }}" class="btn btn-outline-primary">Ver
                    juego</a>
                <button type="button" class="btn float-right btn-outline-danger delete-game w-25"
                    data-game="{{ $tema->game->id }}">Eliminar</button>
            @endif
        @else
            <div class="row justify-content-end">
                <div class="alert alert-danger" role="alert">
                    <strong>Actividad Interactiva no completada</strong>
                </div>
            </div>
            @if (session('role') != 'capacitante')
                <a href="{{ route('game.show', $tema->game) }}" class="btn float-right btn-outline-primary w-25">Ver
                    juego</a>
                <button type="button" class="btn float-right btn-outline-danger delete-game w-25"
                    data-game="{{ $tema->game->id }}">Eliminar</button>
            @endif
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
    @include('layouts.argon_footer')
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
                    setTimeout(() => {
                        location.reload(true)
                    }, 2000);
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
