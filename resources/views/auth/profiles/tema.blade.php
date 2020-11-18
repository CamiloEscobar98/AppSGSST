@extends('layouts.app')
@section('title', 'Temática')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow">
                            <div class="card-header bg-sgsst2 pt">
                                <h4 class="my-0 font-weight-bold">Temática</h4>
                            </div>
                            <div class="card-body">
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
                                        <button type="submit" class="btn btn-block btn-login">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-sgsst2 py-4"></div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 mb-4">
                        <div class="row">
                            <div class="col-md-6">
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
                                                        <option value="{{ $capacitador->email }}">
                                                            {{ $capacitador->fullname() }}
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
                            <div class="col-md-6">
                                <div class="card shadow">
                                    <div class="card-header bg-sgsst2 py-4">
                                        <h4 class="text-white font-weight-bold my-0">Cambiar Foto de Perfil</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('topic.update-photo') }}" method="POST" class="mt-4"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="topic" value="{{ $tema->id }}">
                                            @method('patch')
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file"
                                                        class="custom-file-input @error('image') is-invalid @enderror"
                                                        id="customFile" name="image">
                                                    <label class="custom-file-label" for="customFile">Seleccionar
                                                        foto</label>
                                                </div>
                                                @error('image')
                                                    <small id="helpId"
                                                        class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-login btn-block">Actualizar
                                                    foto</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer bg-sgsst2 py-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-sgsst2 py-3">
                                <h4 class="font-weight-bold my-0">Cápsulas</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-inverse">
                                            <tr class="bg-sgsst2 text-center">
                                                <th style="width: 5%">No.</th>
                                                <th>Título</th>
                                                <th>Link</th>
                                                <th>...</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @forelse ($capsules as $capsula)
                                                <tr id="fila{{ $loop->iteration }}">
                                                    <td>{{ $loop->iteration }}.</td>
                                                    <td>{{ $capsula->title }}</td>
                                                    <td><a href="{{ $capsula->video }}">{{ $capsula->video }}</a></td>
                                                    <td>
                                                        <div class="btn-group w-100">
                                                            <a href="{{ route('capsule.show', $capsula) }}" type="button"
                                                                class="btn btn-primary w-50"><i class="fa fa-eye"
                                                                    aria-hidden="true"></i></a>
                                                            <button type="button" class="btn btn-danger w-50 delete-capsule"
                                                                data-tr="{{ $loop->iteration }}"
                                                                data-title="{{ $capsula->title }}"
                                                                data-capsule="{{ $capsula->id }}"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty

                                            @endforelse
                                        </tbody>
                                        <tfoot class="bg-sgsst2 text-center">
                                            <th>No.</th>
                                            <th>Título</th>
                                            <th>Link</th>
                                            <th>...</th>
                                        </tfoot>
                                    </table>
                                </div>
                                {{ $capsules->links() }}
                            </div>
                            <div class="card-footer bg-sgsst2 py-4"></div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-sgsst2 py-4">
                                <h4 class="font-weight-bold my-0">Juego Interactivo</h4>
                            </div>
                            <div class="card-body row justify-content-center">
                                @if ($tema->game == null)
                                    <form action="{{ route('game.create') }}" method="post" class="col-md-8">
                                        @csrf
                                        <input type="hidden" name="topic" value="{{ $tema->id }}">
                                        <div class="form-group">
                                            <label for="title_game" class="font-weight-bold">Titulo del Juego</label>
                                            <input type="text" name="title_game" id="title_game"
                                                value="{{ old('title_game') }}"
                                                class="form-control @error('title_game') is-invalid @enderror"
                                                placeholder="Titulo del juego" aria-describedby="helpId">
                                            @error('title_game')
                                                <small id="helpId"
                                                    class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="game_type" class="font-weight-bold">Tipo de juego</label>
                                            <select class="custom-select @error('game_type') is-invalid @enderror"
                                                name="game_type" id="game_type">
                                                <option value="-1" selected>Seleccione un tipo de juego</option>
                                                <option value="1">Ahorcado</option>
                                                <option value="2">Crucigrama</option>
                                            </select>
                                            @error('game_type')
                                                <small id="helpId"
                                                    class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-login">Registrar juego</button>
                                        </div>
                                    </form>
                                @else
                                    @if ($tema->game->gameable->words()->count() != null)
                                        <button class="btn btn-block btn-danger">Jugar</button>
                                        <a href="{{ route('game.show', $tema->game) }}" class="btn btn-block btn-login">Ver
                                            juego</a>
                                    @else
                                        <a href="{{ route('game.show', $tema->game) }}" class="btn btn-block btn-login">Ver
                                            juego</a>
                                    @endif
                                @endif
                                <div id="play_game">
                                    
                                </div>
                                @endif
                            </div>
                            <div class="card-footer bg-sgsst2 py-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
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
@endsection
