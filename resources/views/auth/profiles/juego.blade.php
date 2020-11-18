@extends('layouts.app')
@section('title', 'Perfil-Juego')
@section('content')
    <div class="container-fluid mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4">Retroceder</a>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-sgsst2 py-4">
                                <h4 class="font-weight-bold my-0">Juego</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Para actualizar la información del juego, digita sus datos.</p>
                                <form action="{{ route('game.update') }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="game" value="{{ $juego->id }}">
                                    <div class="form-group">
                                        <label for="title" class="font-weight-bold">Titulo del juego</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control text-capitalize @error('title') @enderror"
                                            value="{{ $juego->title }}" aria-describedby="helpId">
                                        @error('title')
                                            <small id="helpId"
                                                class="bg-danger text-white font-weight-bold py-1 px-1">{{ $message }}</small>
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
                                <h4 class="font-weight-bold my-0">Registrar Palabra</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Digita los datos para registrar una palabra</p>
                                <form action="{{ route('word.create') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="game" value="{{ $juego->id }}">
                                    <div class="form-group">
                                        <label for="word" class="font-weight-bold">Palabra</label>
                                        <input type="text" name="word" id="word"
                                            class="form-control @error('word') is-invalid @enderror"
                                            placeholder="Palabra a registrar" aria-describedby="helpId">
                                        @error('word')
                                            <small id="helpId"
                                                class="bg-danger text-white font-weight-bold py-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="clue" class="font-weight-bold">Pista de palabra</label>
                                        <input type="text" name="clue" id="clue"
                                            class="form-control @error('clue') is-invalid @enderror"
                                            placeholder="Pista de la palabra a registrar" aria-describedby="helpId">
                                        @error('clue')
                                            <small id="helpId"
                                                class="bg-danger text-white font-weight-bold py-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-login">Registrar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-sgsst2 py-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header bg-sgsst2 py-4">
                        <h4 class="font-weight-bold my-0">Lista de palabras</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <thead class="bg-sgsst2">
                                    <tr>
                                        <th style="width: 5%">No.</th>
                                        <th class="w-50">Palabra</th>
                                        <th class="w-50">Pista</th>
                                        <th class="w-auto">...</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize">
                                    @forelse ($words as $word)
                                        <tr id="fila{{ $loop->iteration }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $word->word }}</td>
                                            <td>{{ $word->clue }}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="">
                                                    <button type="button" class="btn btn-primary"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></button>
                                                    <button type="button" class="btn btn-danger delete-word"
                                                        data-tr="{{ $loop->iteration }}" data-title="{{ $word->word }}"
                                                        data-word="{{ $word->id }}"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <h4 class="text-center my-4">No hay palabras registradas.</h4>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-sgsst2">
                                    <th>No.</th>
                                    <th>Palabra</th>
                                    <th>Pista</th>
                                    <th>...</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer  bg-sgsst2 py-4"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $('.delete-word').on('click', function() {
        var word = $(this).attr('data-title');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡La palabra " + word.toUpperCase() + " Será eliminada!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var word = $(this).attr('data-word');
                axios.post("{{ route('word.delete') }}", {
                    _method: 'delete',
                    word: word,
                }).then(res => {
                    // console.log(res.data);
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
