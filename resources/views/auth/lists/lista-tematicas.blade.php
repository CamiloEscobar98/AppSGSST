@extends('layouts.app')
@section('title', 'Temáticas')
@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-md-4 mt-5">
                <div class="card shadow">
                    <div class="card-header bg-sgsst2 py-4">
                        <h4 class="font-weight-bold my-0">Registrar Temática</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Por favor llena toda la información para registrar la temática.</p>
                        <form action="{{ route('topic.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Título:</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder=""
                                    aria-describedby="helpId">
                                @error('title')
                                    <small id="helpId" class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="info" class="font-weight-bold">Descripción:</label>
                                <textarea class="form-control @error('info') is-invalid @enderror" name="info" id="info"
                                    aria-describedby="helpId" rows="3"></textarea>
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
                                <button type="submit" class="btn btn-block btn-login">Registrar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-sgsst2 py-4"></div>
                </div>
            </div>
            <div class="col-md-8 mt-5">
                <div class="card shadow">
                    <div class="card-header bg-sgsst2 py-4">
                        <h4 class="font-weight-bold text-white my-0">Lista de temáticas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="bg-sgsst2 font-weight-bold text-center">
                                    <tr>
                                        <th class="">Encargado</th>
                                        <th class="">Título</th>
                                        <th class="w-50">Descripción</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tematicas as $tema)
                                        <tr class="text-center" id="fila{{ $loop->iteration }}">
                                            <td><a
                                                    href="{{ route('user.show', $tema->user) }}">{{ $tema->user->fullname() }}</a>
                                            </td>
                                            <td>{{ $tema->title }}</td>
                                            <td>{{ $tema->info }}</td>
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
                                <tfoot class="bg-sgsst2 font-weight-bold text-center">
                                    <th>Encargado</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>...</th>
                                </tfoot>
                            </table>
                        </div>
                        {{ $tematicas->links() }}
                    </div>
                    <div class="card-footer bg-sgsst2 py-4"></div>
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
@endsection
