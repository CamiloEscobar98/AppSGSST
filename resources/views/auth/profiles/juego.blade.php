@extends('layouts.argon')
@section('title', 'Perfil-Juego')
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
    <div class="container-fluid mt-4 mb-4">
        <div class="card">
            <div class="card-header bg-translucent-white">
                <h2 class="font-weight-bold mt-3">Lista de palabras</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-center">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="bg-translucent-default" style="width: 5%">No.</th>
                                <th class="bg-translucent-white" class="w-50">Palabra</th>
                                <th class="bg-translucent-default" class="w-50">Pista</th>
                                @if (session('role') != 'capacitante')
                                    <th class="bg-translucent-white" style="width: 5%">...</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($words as $word)
                                <tr id="fila{{ $loop->iteration }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $word->word }}</td>
                                    <td>{{ $word->clue }}</td>
                                    @if (session('role') != 'capacitante')
                                        <td>
                                            <div class="btn-group" role="group" aria-label="">
                                                <button type="button" class="btn btn-danger delete-word"
                                                    data-tr="{{ $loop->iteration }}" data-title="{{ $word->word }}"
                                                    data-word="{{ $word->id }}"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <h4 class="text-center my-4">No hay palabras registradas.</h4>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 {{ checkColGame(session('role')) }}">
                @if (session('role') != 'capacitante')
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-translucent-white">
                                <h2 class="font-weight-bold mt-3">Registrar Palabra</h2>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Digita los datos para registrar una palabra</p>
                                <form action="{{ route('word.create') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
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
                                        </div>
                                        <div class="col-md-6">
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
                                        </div>
                                    </div>
                                    <input type="hidden" name="game" value="{{ $juego->id }}">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-outline-primary">Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-12 {{ checkColGame(session('role')) }}">
                <div class="card">
                    <div class="card-header bg-translucent-white">
                        <h2 class="font-weight-bold mt-3">Perfil Juego</h2>
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
                                    value="{{ $juego->title }}" aria-describedby="helpId" {{ checkInput(session('role')) }}>
                                @error('title')
                                    <small id="helpId"
                                        class="bg-danger text-white font-weight-bold py-1 px-1">{{ $message }}</small>
                                @enderror
                            </div>
                            @if (session('role') != 'capacitante')
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-outline-primary">Actualizar</button>
                                </div>
                            @endif
                        </form>
                    </div>
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
