@extends('layouts.argon')
@section('title', 'Temáticas')
@section('content')
    @include('layouts.argon_nav_user_2')
    <div class="container-fluid mb-4">
        <div class="card shadow-lg mt-5">
            <div class="card-header bg-translucent-white">
                <h2 class="font-weight-bold my-0 mt-3">Lista de temáticas</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-primary font-weight-bold text-center text-white">
                            <tr>
                                <th class="bg-translucent-default">Foto</th>
                                <th class="bg-translucent-white">Encargado</th>
                                <th class="bg-translucent-default">Título</th>
                                <th class="bg-translucent-white" style="width: 5%">...</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tematicas as $tema)
                                <tr class="text-center" id="fila{{ $loop->iteration }}">
                                    <td> <img src="{{ asset($tema->image->fullimage()) }}"
                                            class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} mx-auto d-block"
                                            alt="" width="50vh"></td>
                                    <td>
                                        @if ($tema->user)
                                            <a href="{{ route('user.show', $tema->user) }}">{{ $tema->user->fullname() }}</a>
                                        @else
                                            <p class="bg-danger text-white px-2 rounded-pill">No tiene encargado
                                                asignado</p>
                                        @endif
                                    </td>
                                    <td>{{ $tema->title }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('topic.show', $tema) }}" type="button"
                                                class="btn btn-outline-primary mr-2"><i class="fa fa-eye"
                                                    aria-hidden="true"></i></a>
                                            <button type="button" class="btn btn-outline-danger delete-topic"
                                                data-tr="{{ $loop->iteration }}" data-title="{{ $tema->title }}"
                                                data-topic="{{ $tema->id }}"><i class="fa fa-trash"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="float-left ml-3">
                {{ $tematicas->links() }}
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-header bg-translucent-white">
                <h2 class="font-weight-bold my-0 mt-3">Registrar Temática</h2>
            </div>
            <div class="card-body">
                <p class="card-text font-weight-bold">Por favor llena toda la información para registrar la temática.</p>
                <form action="{{ route('topic.create') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Título:</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder=""
                                    value="{{ old('title') }}" aria-describedby="helpId">
                                @error('title')
                                    <small id="helpId" class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
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

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="info" class="font-weight-bold">Descripción:</label>
                        <textarea class="form-control @error('info') is-invalid @enderror" name="info" id="info"
                            aria-describedby="helpId" rows="3">{{ old('info') }}</textarea>
                        @error('info')
                            <small id="helpId" class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group float-right">
                        <button type="submit" class="btn btn-outline-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.argon_footer')
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
