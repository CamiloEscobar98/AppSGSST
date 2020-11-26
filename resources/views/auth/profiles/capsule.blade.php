@extends('layouts.app')
@section('title', 'Cápsula')
@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-header bg-sgsst2 py-4">
                                <h4 class="my-0 font-weight-bold">Cápsula</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Para actualizar la cápsula, llena las credenciales</p>
                                <form action="{{ route('capsule.update') }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="capsule" value="{{ $capsule->id }}">
                                    <div class="form-group">
                                        <label for="title" class="font-weight-bold">Tiutlo</label>
                                        <input type="text" name="title" id="title"
                                            class="form-control text-capitalize @error('title') is-invalid @enderror"
                                            value="{{ $capsule->title }}" aria-describedby="helpId">
                                        @error('title')
                                            <small id="helpId"
                                                class="font-weight-bold bg-danger py-y text-white">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="video" class="font-weight-bold">Video</label>
                                        <input type="text" name="video" id="video"
                                            class="form-control @error('video') is-invalid @enderror"
                                            value="{{ $capsule->video }}" aria-describedby="helpId">
                                        @error('video')
                                            <small id="helpId"
                                                class="font-weight-bold bg-danger py-y text-white">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="info" class="font-weight-bold">Descripción</label>
                                        <textarea class="form-control @error('info') is-invalid @enderror" name="info"
                                            id="info" rows="3">{{ $capsule->info }}</textarea>
                                        @error('info')
                                            <small id="helpId"
                                                class="font-weight-bold bg-danger py-y text-white">{{ $message }}</small>
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
                                <h4 class="font-weight-bold my-0">Cambiar temática</h4>
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
                                                    <option value="{{ $topic->id }}" selected>{{ $topic->title }}</option>
                                                @endif
                                                <option value="{{ $topic->id }}">{{ $topic->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-login">Cambiar temática</button>
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
                    <div class="card-header bg-sgsst2 py-4"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ $capsule->video }}"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-sgsst2 py-4"></div>
                </div>
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
