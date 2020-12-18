@extends('layouts.argon')
@section('title', 'Todas las temáticas')
@section('content')
    @include('layouts.argon_nav_user_2')
    <div class="container-fluid mt-4 mb-4">
        <div class="my-4">
            @if (auth()
            ->user()
            ->completeTopics())
                <div class="mt-4">
                    <div class="alert alert-default" role="alert">
                        <strong>¡Increíble!</strong> Has terminado de realizar todas las temáticas de la inducción.
                    </div>
                    @if (!Auth()->user()->formato)
                        <a href="{{ route('user.formato') }}" class="btn btn-outline-success">Realizar Formato de
                            Inducción</a>
                    @else
                        {{-- {{ Auth()->user()->formato }} --}}
                        <a href="{{ route('user.downloadformato', Auth()->user()->formato) }}"
                            class="btn btn-outline-default">Descargar Formato</a>
                    @endif
                </div>
            @endif
        </div>
        <h2 class="font-weight-bold">Todas las temáticas</h2>
        <hr>
        <div class="row justify-content-start">
            @forelse ($topics as $topic)
                <div class="col-12 col-md-4 mt-2 mb-4">
                    <div class="card h-100 rounded">
                        <div class="card-header bg-default"></div>
                        <div class="card-body">
                            <h4 class="card-title">
                                Estado
                            </h4>
                            {!! isCompleted($topic) !!}
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
                            <p class="card-text">{{ $topic->info }}</p>

                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group float-right" role="group" aria-label="">

                                @if (!Auth()
                ->user()
                ->hasTopic($topic->title))
                                    <button type="button" class="btn btn-outline-success btn-inscribir"
                                        data-topic="{{ $topic->title }}">Iniciar</button>
                                @else
                                    @if ($topic->game)
                                        <a href="{{ route('topic.show', $topic) }}" class="btn btn-outline-primary"><i
                                                class="fa fa-eye mr-2" aria-hidden="true"></i>Visualizar</a>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                            <strong>No disponible</strong>
                                        </div>
                                    @endif
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
        {{ $topics->links() }}
    </div>
@endsection
@section('scripts')
<script>
    $('.btn-inscribir').on('click', function() {
        var topic = $(this).attr('data-topic');
        axios.post("{{ route('user.addtopic') }}", {
            topic: topic,
            user: "{{ Auth()->user()->id }}"
        }).then(res => {
            // console.log(res.data);
            Swal.fire({
                title: res.data.title,
                text: res.data.message,
                icon: res.data.alert
            });
            setTimeout(() => {
                location.reload(true)
            }, 2000);

        }).catch(res => {
            // console.log(res);
            Swal.fire({
                title: res.data.title,
                text: 'Error, no se ha inscrito correctamente a la temática.',
                icon: 'error'
            });
        });
    });

</script>
@endsection
