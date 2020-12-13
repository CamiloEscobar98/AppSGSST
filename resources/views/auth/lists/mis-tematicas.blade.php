@extends('layouts.argon')
@section('title', 'Temáticas')
@section('content')
    @include('layouts.argon_nav_user_2')
    <div class="container-fluid">
        <div class="row">
            @forelse ($topics as $topic)
                <div class="col-12 col-md-3 my-4">
                    <div class="card h-100 rounded">
                        <div class="card-header bg-default"></div>
                        <div class="card-body">
                            <img src="{{ asset($topic->image->fullimage()) }}"
                                class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} mx-auto d-block"
                                alt="" width="100vh">
                            <h4 class="card-title font-weight-bold">Tema </h4>
                            <div class="card-text">
                                <p> {{ $topic->title }}</p>
                            </div>
                            <div class="card-title">
                                Descripción
                            </div>
                            <p>{{ $topic->info }}</p>
                        </div>
                        <div class="card-footer bg-sgsst2 py-4">
                            <a href="{{ route('topic.show', $topic) }}" class="btn btn-outline-default"><i class="fa fa-eye mr-2"
                                    aria-hidden="true"></i>Ver</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-8 mx-auto text-center my-4">
                    <div class="alert alert-danger">
                        <strong>No tienes temáticas asignadas. Por favor, solicita que el administrador te asigne alguna
                            temática.</strong>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
