@extends('layouts.argon')
@section('title', 'Temáticas')
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
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-md-4 mt-5">
                <div class="card shadow">
                    <div class="card-header bg-primary py-4">
                        <h4 class="font-weight-bold my-0 text-white">Registrar Temática</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Por favor llena toda la información para registrar la temática.</p>
                        <form action="{{ route('topic.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Título:</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder=""
                                    value="{{ old('title') }}" aria-describedby="helpId">
                                @error('title')
                                    <small id="helpId" class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="info" class="font-weight-bold">Descripción:</label>
                                <textarea class="form-control @error('info') is-invalid @enderror" name="info" id="info"
                                    aria-describedby="helpId" rows="3">{{ old('info') }}</textarea>
                                @error('info')
                                    <small id="helpId" class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="capacitador" class="font-weight-bold">Capacitador:</label>
                                <select class="form-control @error('capacitador') is-invalid @enderror" name="capacitador"
                                    id="capacitador">
                                    <option value="-1">Seleccione un capacitador</option>
                                    @foreach ($capacitadores as $capacitador)
                                        <option value="{{ $capacitador->email }}">{{ $capacitador->fullname() }}</option>
                                    @endforeach
                                </select>
                                @error('capacitador')
                                    <small id="helpId" class="text-white bg-danger py-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Registrar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-primary py-4"></div>
                </div>
            </div>
            <div class="col-md-8 mt-5">
                <div class="card shadow">
                    <div class="card-header bg-primary py-4">
                        <h4 class="font-weight-bold text-white my-0">Lista de temáticas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="bg-primary font-weight-bold text-center text-white">
                                    <tr>
                                        <th>Foto</th>
                                        <th>Encargado</th>
                                        <th>Título</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tematicas as $tema)
                                        <tr class="text-center" id="fila{{ $loop->iteration }}">
                                            <td> <img src="{{ asset($tema->image->fullimage()) }}"
                                                    class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} mx-auto d-block"
                                                    alt="" width="50vh"></td>
                                            <td><a
                                                    href="{{ route('user.show', $tema->user) }}">{{ $tema->user->fullname() }}</a>
                                            </td>
                                            <td>{{ $tema->title }}</td>
                                            <td>
                                                <div class="btn-group w-100">
                                                    <a href="{{ route('topic.show', $tema) }}" type="button"
                                                        class="btn btn-primary w-50"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></a>
                                                    <button type="button" class="btn btn-danger w-50 delete-topic"
                                                        data-tr="{{ $loop->iteration }}" data-title="{{ $tema->title }}"
                                                        data-topic="{{ $tema->id }}"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                                <tfoot class="bg-primary font-weight-bold text-center text-white">
                                    <th>Foto</th>
                                    <th>Encargado</th>
                                    <th>Título</th>
                                    <th>...</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    {{ $tematicas->links() }}
                    <div class="card-footer bg-primary py-4"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $('.delete-topic').on('click', function() {
        var topic = $(this).attr('data-title');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡La temática " + topic.toUpperCase() + " Será eliminado!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                var topic = $(this).attr('data-topic');
                axios.post("{{ route('topic.delete') }}", {
                    _method: 'delete',
                    topic: topic,
                }).then(res => {
                    console.log(res.data);
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
@endsection
