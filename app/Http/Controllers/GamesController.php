<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function create(\App\Http\Requests\Game\CreateGameRequest $request)
    {
        $validated = $request->validated();
        $save = $this->insertGame($validated);
        if ($save) {
            return redirect()->back()->with('create_complete', 'Se registró correctamente el juego: ' . $save->title);
        }
        return redirect()->back()->with('create_failed', 'No se ha registrado correctamente el juego.');
    }

    public function show(\App\Models\Game $game)
    {
        return view('auth.profiles.juego', ['juego' => $game, 'words' => $game->gameable->words()->paginate(5)]);
    }

    public function update(\App\Http\Requests\Game\UpdateGameRequest $request)
    {
        $validated = $request->validated();
        $update = $this->updateGame($validated);
        if ($update) {
            return redirect()->back()->with('update_complete', 'Se actualízo correctamente el juego: ' . $update->title);
        }
        return redirect()->back()->with('update_failed', 'No se ha actualizado correctamente el juego.');
    }

    public function getHangman(Request $request)
    {
        if ($request->ajax()) {
            $hangman = \App\Models\Hangman::find($request->id);
            return $hangman->words;
        }
    }

    public function getWordFind(Request $request)
    {
        if ($request->ajax()) {
            $wordfind = \App\Models\Wordfind::find($request->id);
            return $wordfind->words;
        }
    }
    private function insertGame($validated)
    {
        switch ($validated['game_type']) {
            case 1:
                // Hangman
                $hangman = \App\Models\Hangman::create();
                $game =  $hangman->game()->create([
                    'topic_id' => $validated['topic'],
                    'type' => $validated['game_type'],
                    'title' => strtolower($validated['title_game'])
                ]);
                return $game;
                break;

            case 2:
                $wordfind = \App\Models\Wordfind::create();
                $game = $wordfind->game()->create([
                    'topic_id' => $validated['topic'],
                    'type' => $validated['game_type'],
                    'title' => strtolower($validated['title_game'])
                ]);
                return $game;
                break;
            default:
                # code...
                break;
        }
    }

    private function updateGame($validated)
    {
        $game = \App\Models\Game::find($validated['game']);
        $game->update([
            'title' => strtolower($validated['title'])
        ]);
        return $game;
    }
}
