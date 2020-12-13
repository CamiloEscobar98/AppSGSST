<link href="{{ asset('css/hangman.css') }}" rel="stylesheet">
<section class="container-fluid my-2">
    <div class="card rounded shadow">
        <div class="card-header bg-sgsst py-4"></div>
        <div class="card-body">
            <div class="wrapper">
                <input type="hidden" id="hangman_id" value="{{ $tema->game->gameable->id }}">
                <input type="hidden" id="role" value="{{ session('role') }}">
                <input type="hidden" id="user" value="{{ Auth()->user()->email }}">
                <h1>{{ $tema->game->gameable->word }}</h1>
                <h2>El clasico juego del Ahorcado</h2>
                <p>Utilice el alfabeto de abajo para adivinar la palabra, o haga clic en Revelar Pista para obtener una
                    pista.
                </p>
            </div>
            <div class="wrapper">
                <div id="buttons">
                </div>
                <div id="hold">
                </div>
                <p id="mylives"></p>
                <p id="clue"></p>
                <canvas id="stickman">This Text will show if the Browser does NOT support HTML5 Canvas tag</canvas>
            </div>
        </div>
        <div class="card-footer bg-sgsst">
            <div class="btn-group w-100">
                <button id="hint" class="btn btn-warning rounded font-weight-bold buttones">Revelar Pista</button>
                <button id="reset" class="btn btn-danger rounded font-weight-bold buttones">Juega de Nuevo</button>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('js/hangman.js') }}" defer></script>
