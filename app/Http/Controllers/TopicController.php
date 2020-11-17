<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function create(\App\Http\Requests\Topic\CreateTopicRequest $request)
    {
        $validated = $request->validated();
        $save = $this->inserTopic($validated);
        if ($save) {
            return redirect()->back()->with('create_complete', 'Se registró correctamente la temática: ' . $save->title);
        }
        return redirect()->back()->with('create_failed', 'No se ha registrado correctamente la temática.');
    }

    public function show(\App\Models\Topic $topic)
    {
        $capacitadores = \App\Models\Role::where('name', 'capacitador')->first()->users;
        return view('auth.profiles.tema', ['tema' => $topic, 'capacitadores' => $capacitadores]);
    }

    public function update(\App\Http\Requests\Topic\UpdateTopicRequest $request)
    {
        $validated = $request->validated();
        $update = $this->updateTopic($validated);
        if ($update) {
            return redirect()->back()->with('create_complete', 'Se actualizó correctamente la temática');
        }
        return redirect()->back()->with('create_failed', 'No se pudo actualizar correctamente la temática.');
    }

    public function update_capacitante(\App\Http\Requests\Topic\UpdateTopicCapacitanteRequest $request)
    {
        $validated = $request->validated();
        $capacitador = \App\User::where('email', $validated['capacitador'])->first();
        $topic = \App\Models\Topic::find($request->topic);
        $update = $topic->update([
            'user_id' => $capacitador->id
        ]);
        if ($update) {
            return redirect()->back()->with('create_complete', 'Se actualizó el capacitador de la temática');
        }
        return redirect()->back()->with('create_failed', 'No se pudo actualizar correctamente.');
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $topic = \App\Models\Topic::find($request->topic);
            $aux = $topic;
            if ($topic->delete()) {
                return response()->json(['alert' => 'success', 'message' => 'Se ha eliminado correctamente la temática ' . $aux->title]);
            }
            return response()->json(['alert' => 'error', 'message' => 'Error en la eliminación de la temática.']);
        }
    }

    private function inserTopic($validated)
    {
        $capacitador = \App\User::where('email', $validated['capacitador'])->first();
        $topic = \App\Models\Topic::create([
            'title' => strtolower($validated['title']),
            'info' => $validated['info'],
            'user_id' => $capacitador->id
        ]);

        return $topic;
    }

    private function updateTopic($validated)
    {
        $topic = \App\Models\Topic::find($validated['topic']);
        $topic->update([
            'title' => strtolower($validated['title']),
            'info' => $validated['info']
        ]);

        return $topic;
    }
}
