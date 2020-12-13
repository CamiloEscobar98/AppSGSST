@extends('layouts.argon')
@section('title', 'Cápsulas')
@section('content')
    @include('layouts.argon_nav_user_2')
    <div class="container-fluid mb-4">
        <div class="card shadow mt-5">
            <div class="card-header bg-translucent-white">
                <h2 class="font-weight-bold mt-3">Lista de Cápsulas</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-primary font-weight-bold text-white text-center">
                            <tr>
                                <th class="bg-translucent-default">Temática</th>
                                <th class="bg-translucent-white">Título</th>
                                <th class="bg-translucent-default w-50">Descripción</th>
                                <th class="bg-translucent-white" style="width: 5%">...</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($capsulas as $capsula)
                                <tr class="text-center" id="fila{{ $loop->iteration }}">
                                    <td><a href="{{ route('topic.show', $capsula->topic) }}">{{ $capsula->topic->title }}</a>
                                    </td>
                                    <td>{{ $capsula->title }}</td>
                                    <td>{{ $capsula->info }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('capsule.show', $capsula) }}" type="button"
                                                class="btn btn-outline-primary mr-2"><i class="fa fa-eye"
                                                    aria-hidden="true"></i></a>
                                            <button type="button" class="btn btn-outline-danger  delete-capsule"
                                                data-tr="{{ $loop->iteration }}" data-title="{{ $capsula->title }}"
                                                data-capsule="{{ $capsula->id }}"><i class="fa fa-trash"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <h4 class="text-center my-4">No hay cápsulas registradas.</h4>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="float-left ml-3">
                    {{ $capsulas->links() }}
                </div>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header bg-translucent-white">
                <h2 class="font-weight-bold mt-3">Registrar Cápsula</h2>
            </div>
            <div class="card-body">
                <p class="card-text">Por favor llena toda la información para registrar la cápsula.</p>
                <form action="{{ route('capsule.create') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="video" class="font-weight-bold">URL del vídeo:</label>
                                <input type="url" name="video" id="video"
                                    class="form-control @error('video') is-invalid @enderror" placeholder=""
                                    value="{{ old('video') }}" aria-describedby="helpId">
                                @error('video')
                                    <small id="helpId" class="text-white font-weight-bold bg-danger py-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="topic" class="font-weight-bold">Temática:</label>
                                <select class="form-control @error('topic') is-invalid @enderror" name="topic" id="topic">
                                    <option value="-1">Seleccione una temática</option>
                                    @foreach ($tematicas as $tema)
                                        <option value="{{ $tema->id }}">{{ $tema->title }}</option>
                                    @endforeach
                                </select>
                                @error('topic')
                                    <small id="helpId" class="text-white bg-danger py-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <button type="submit" class="btn btn-outline-primary">Registrar</button>
                    </div>
                </form>
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
