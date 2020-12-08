@extends('layouts.app')
@section('title', 'Todas las temáticas')
@section('content')
    <div class="container-fluid">
        <h4 class="mt-4 mb-2">Todas las temáticas</h4>
        <hr>
        <div class="row justify-content-start">
            @forelse ($topics as $topic)
                <div class="col-12 col-md-4 mt-2 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-sgsst2 py-4"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <img src="{{ asset($topic->image->fullimage()) }}"
                                        class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} mx-auto d-block"
                                        alt="" width="100vh">
                                </div>
                                <div class="col-12 col-md-8">
                                    <h4 class="card-title font-weight-bold">Temática </h4>
                                    <p class="card-text">
                                        {{ $topic->title }}
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="btn-group w-100 mt-2" role="group" aria-label="">

                                @if (!Auth()
                ->user()
                ->hasTopic($topic->title))
                                    <button type="button" class="btn btn-info btn-insc"
                                        data-topic="{{ $topic->title }}">Inscribir</button>
                                @else
                                    <button type="button" class="btn btn-primary"><i class="fa fa-eye mr-2"
                                            aria-hidden="true"></i>Visualizar</button>
                                @endif


                            </div>
                        </div>
                        <div class="card-footer bg-sgsst2 py-4"></div>
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
    $('.btn-insc').on('click', function() {
        var topic = $(this).attr('data-topic');
        axios.post("{{ route('user.addtopic') }}", {
            topic: topic,
            user: "{{ Auth()->user()->id }}"
        }).then(res => {
            console.log(res.data);
            Swal.fire({
                title: '¡Éxito!',
                text: res.data.message,
                icon: res.data.alert
            });

        }).catch(res => {
            console.log(res);
            var titulo = (res.alert == 'success') ? '¡Eliminado!' : '¡Error';
            Swal.fire({
                title: '¡Error!',
                text: 'Error, no se ha inscrito correctamente a la temática.',
                icon: 'error'
            });
        });
    });

</script>
@endsection
