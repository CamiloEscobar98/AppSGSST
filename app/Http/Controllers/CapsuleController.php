<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapsuleController extends Controller
{



    public function create(\App\Http\Requests\Capsule\CreateCapsuleRequest $request)
    {
        $validated = $request->validated();
        $save = $this->insertCapsule($validated);
        if ($save) {
            return redirect()->back()->with('create_complete', 'Se registró correctamente la cápsula: ' . $save->title);
        }
        return redirect()->back()->with('create_failed', 'No se ha registrado correctamente la cápsula.');
    }

    public function show(\App\Models\Capsule $capsule)
    {
        $tematicas = \App\Models\Topic::all();
        return view('auth.profiles.capsule', ['capsule' => $capsule, 'tematicas' => $tematicas]);
    }

    public function update(\App\Http\Requests\Capsule\UpdateCapsuleRequest $request)
    {
        $validated = $request->validated();
        $update = $this->updateCapsule($validated);
        if ($update) {
            return redirect()->back()->with('update_complete', 'Se actualizó correctamente la cápsula: ' . $update->title);
        }
        return redirect()->back()->with('update_failed', 'No se ha actualizado correctamente la cápsula.');
    }

    public function changeTopic(Request $request)
    {
        $rules = [
            'topic' => ['required', 'exists:topics,id'],
            'capsule' => ['required', 'exists:capsules,id']
        ];
        $attributes = [
            'topic' => 'temática de la cápsula',
            'capsule' => 'cápsula'
        ];
        $validated =  $request->validate($rules, [], $attributes);
        $capsule = \App\Models\Capsule::find($validated['capsule']);
        $update =  $capsule->update(['topic_id' => $validated['topic']]);
        if ($update) {
            return redirect()->back()->with('update_complete', 'Se actualizó correctamente la temática de la cápsula');
        }
        return redirect()->back()->with('update_failed', 'No se ha actualizado correctamente la cápsula.');
    }

    private function insertCapsule($validated)
    {
        $topic = \App\Models\Topic::find($validated['topic']);
        $capsula = \App\Models\Capsule::create([
            'topic_id' => $validated['topic'],
            'title' => $validated['title'],
            'info' => $validated['info'],
            'video' => $validated['video']
        ]);

        return $capsula;
    }

    private function updateCapsule($validated)
    {
        $capsula = \App\Models\Capsule::find($validated['capsule']);
        $capsula->update([
            'title' => strtolower($validated['title']),
            'info' => $validated['info'],
            'video' => $validated['video']
        ]);

        return $capsula;
    }

    public function destroy(Request $request)
    {
        $capsule = \App\Models\Capsule::find($request->capsule);
        $aux = $capsule;
        if ($capsule->delete()) {
            return response()->json(['alert' => 'success', 'message' => 'Se ha eliminado correctamente la cápsula ' . $aux->title]);
        }
        return response()->json(['alert' => 'error', 'message' => 'Error en la eliminación de la cápsula.']);
    }
}
