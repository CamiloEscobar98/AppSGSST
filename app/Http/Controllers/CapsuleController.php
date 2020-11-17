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

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            
        }
    }
}
