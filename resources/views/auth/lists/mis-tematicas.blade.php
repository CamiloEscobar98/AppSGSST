@extends('layouts.app')
@section('title', 'Temáticas')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            @forelse ($topics as $topic)
                <div class="col-12 col-md-3 my-4">
                    <div class="card h-100">
                        <div class="card-header bg-sgsst2 py-4"></div>
                        <div class="card-body">
                            <img src="{{ $topic->image->fullimage() }}" width="150vh" height="150vh"
                                class="float-right px-2 img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} mx-auto d-block"
                                alt="">
                            <h4 class="card-title">Temática:</h4>
                            <p>{{ $topic->title }}</p>
                            <p class="card-text text-justify">{{ $topic->info }}</p>
                            <a href="{{ route('topic.show', $topic) }}" class="btn btn-block btn-login">Ver</a>
                        </div>
                        <div class="card-footer bg-sgsst2 py-4"></div>
                    </div>
                </div>
            @empty
                <div class="col-8 mx-auto text-center my-4">
                    <div class="alert alert-danger">
                        <strong>No tienes temáticas asignadas. Por favor, solicita que el administrador te asigne alguna temática.</strong>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
