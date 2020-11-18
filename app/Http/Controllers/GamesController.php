<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function create(\App\Http\Requests\Game\CreateGameRequest $request)
    {
        $validated = $request->validated();
        return $validated;
        $save = $this->insertGame($validated);
        if ($save) {
            // return redirect()->back()->with('create_complete', 'Se registró correctamente el juego: ' . $save->title);
        }
        return redirect()->back()->with('create_failed', 'No se ha registrado correctamente el juego.');
    }

    private function insertGame($validated)
    {
        $game = \App\Models\Game::create();
    }
}
