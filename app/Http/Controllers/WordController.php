<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordController extends Controller
{
    public function create(\App\Http\Requests\Word\CreateWordRequest $request)
    {
        $validated = $request->validated();
        $save = $this->insertWord($validated);
        if ($save) {
            return redirect()->back()->with('create_complete', 'Se registró correctamente la palabra: ' . $save->word);
        }
        return redirect()->back()->with('create_failed', 'No se ha registrado correctamente la palabra.');
    }

    public function destroy(Request $request)
    {
        $word = \App\Models\Word::find($request->word);
        $aux = $word;
        if ($word->delete()) {
            return response()->json(['alert' => 'success', 'message' => 'Se ha eliminado correctamente la palabra ' . $aux->word]);
        }
        return response()->json(['alert' => 'error', 'message' => 'Error en la eliminación de la palabra.']);
    }

    private function insertWord($validated)
    {
        $game = \App\Models\Game::find($validated['game']);
        $word = $game->gameable->words()->create([
            'word' => strtolower($validated['word']),
            'clue' => strtolower($validated['clue'])
        ]);
        return $word;
    }
}
