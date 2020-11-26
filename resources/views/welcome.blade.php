@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-5 mt-4">
                <div class="card">
                    <div class="card-header py-4 bg-sgsst2">
                        <h4 class="my-0 font-weight-bold"> Todas nuestras temáticas</h4>
                    </div>
                    <div class="card-body">
                        <div id="demo" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                @foreach ($topics as $topic)
                                    <li data-target="#demo" data-slide-to="{{ $loop->iteration }}"
                                        class="{{ isFirst($loop->iteration) }}"></li>
                                @endforeach
                            </ul>
                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                @foreach ($topics as $topic)
                                    <div class="carousel-item {{ isFirst($loop->iteration) }}">
                                        <img src="{{ $topic->image->fullimage() }}" class="mx-auto d-flex" alt="Los Angeles"
                                            width="400vh" height="400vh">
                                        <div class="carousel-caption">
                                            <h4>{{ $topic->title }}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Left and right controls -->
                            <a class="carousel-control-prev bg-sgsst" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon "></span>
                            </a>
                            <a class="carousel-control-next bg-sgsst" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon "></span>
                            </a>

                        </div>
                    </div>
                    <div class="card-footer bg-sgsst2 py-4"></div>
                </div>
            </div>
            <div class="col-12 col-md-7"></div>
        </div>
    </div>
@endsection
