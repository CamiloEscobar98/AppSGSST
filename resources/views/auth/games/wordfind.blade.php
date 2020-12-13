<link href="{{ asset('css/wordfind.css') }}" rel="stylesheet">
<div class="container-fluid my-2">
    <script language="javascript" type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/wordfind.js') }}"></script>
    <script src="{{ asset('js/wordfindgame.js') }}"></script>
    <input type="hidden" id="wordfind" value="{{ $tema->game->gameable->id }}">
    <input type="hidden" id="role" value="{{ session('role') }}">
    <input type="hidden" id="user" value="{{ Auth()->user()->email }}">
    <div class="card">
        <div class="card-header bg-sgsst text-center py-4">
            <h2 class="my-0"> Sopa de Letras</h2>
        </div>
        <div class="card-body mx-auto">
            <div id='puzzle'></div>
            <div id='words' class=''></div>
        </div>
        <div class="card-footer py-4 bg-sgsst">
            <div class="btn-group w-100 my-0">
                <button id='solve' class="btn btn-primary w-100">Resolver la Sopa de Letras Puzzle</button>
                <button id='crear' class="btn btn-warning w-100">Reintentar</button>
            </div>
        </div>
    </div>
</div>
<script>
    //El juego se crea automatico con las palabras que se tienen en el arreglo de words, entonces ha que buscar la manera de llenar el arreglo 
    var wordfind = $tmp = document.getElementById('wordfind').value;
    var words = [];
    let url = 'http://sgsst.com.devel/';
    $.ajax({
        async: false,
        type: 'POST',
        url: url + 'api/game/wordfind',
        data: {
            id: wordfind
        },
        dataType: 'json'
    }).done(function(data) {
        console.log(data);
        tmp = [];
        data.forEach(word => {
            words.push(word.word);
        });
    });
    // words = ['Develoteca', 'cursos', 'ayuda', 'Videos', 'Tutoriales', 'Plugins', 'hola', 'prueba'];
    /*
    El metodo create recibe como parametros el arreglo con las palabras
    y los divs en donde se va a dibujar la sopa de letras y la lista con las palabras 
    */
    var gamePuzzle = wordfindgame.create(words, '#puzzle', '#words');
    /*
    El metodo solve es una función que permite resolver el juego de sopa de letras me pide como parametros el puzzle y las palabras, cuando se ejecuta
    pinta las palabras en la sopa de letras
    */
    $('#solve').click(function() {
        wordfindgame.solve(gamePuzzle, words);
    });
    /*
    Este metodo crear me permite que se vuelva a crear el puzzle cuando el usuario presione el boton de reintentar, pide como parametros el arreglo de palabras y los contenedores en donde se va a pintar la sopa de letras y la lista de palabras de estas
    */
    $('#crear').click(function() {
        wordfindgame.create(words, '#puzzle', '#words');
    });
    var puzzle = wordfind.newPuzzle(words, {
        height: 18,
        width: 18,
        fillBlanks: false
    });
    wordfind.print(puzzle);

</script>
