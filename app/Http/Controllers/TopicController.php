<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware("checkRoute:capacitador_administrador")->only(['update', 'updatePhoto']);
    }

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
        $myusers = $topic->users;
        $capsules = $topic->capsules()->paginate(5);
        return view('auth.profiles.tema', [
            'tema' => $topic,
            'capacitadores' => $capacitadores,
            'capsules' => $capsules,
            'myusers' => $myusers,
            'capsules' => $topic->capsules()->paginate(5)
        ]);
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

    public function updatePhoto(Request $request)
    {
        $rules = [
            'topic' => ['required', 'exists:topics,id'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048']
        ];
        $attributes = [
            'image' => 'foto de temática'
        ];
        $validated = $request->validate($rules, [], $attributes);
        $topic = \App\Models\Topic::find($validated['topic']);

        $image_path = public_path('storage/images/topics') . '/' . $topic->image->image;
        if ($topic->image->image != 'default.png' && @getimagesize($image_path)) {
            unlink($image_path);
        }
        $image = $request->file('image');
        $nombre = time() . '_' . $topic->id . '.' . $image->getClientOriginalExtension();
        $destino = public_path('storage/images/topics');
        request()->image->move($destino, $nombre);
        $topic->image->image = $nombre;
        $topic->image->url = 'storage/images/topics';
        $update = $topic->image->save();
        if ($update) {
            return redirect()->back()->with('update_complete', 'Se actualizó correctamente la foto de la temática.');
        }
        return redirect()->back()->with('update_failed', 'No se pudo actualizar la foto de la temática.');
    }

    public function destroy(Request $request)
    {
        $topic = \App\Models\Topic::find($request->topic);
        $aux = $topic;
        $delete = \App\Models\Topic::destroy($topic->id);
        if ($delete) {
            return response()->json(['alert' => 'success', 'message' => 'Se ha eliminado correctamente la temática ' . $aux->title]);
        }
        return response()->json(['alert' => 'error', 'message' => 'Error en la eliminación de la temática.']);
    }

    private function inserTopic($validated)
    {
        $capacitador = \App\User::where('email', $validated['capacitador'])->first();
        $topic = \App\Models\Topic::create([
            'title' => strtolower($validated['title']),
            'info' => $validated['info'],
            'user_id' => $capacitador->id
        ]);
        $topic->image()->create([
            'image' => 'default.png',
            'url' => 'storage/images/topics'
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
