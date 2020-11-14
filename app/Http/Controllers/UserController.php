<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(\App\Http\Requests\User\CreateUserRequest $request)
    {
        // return $request;
        $validated = $request->validated();
        $save = $this->insertUser($validated);
        if ($save) {
            return redirect()->back()->with('create_complete', 'Se registró correctamente el usuario: ' . $save->name . ' ' . $save->lastname);
        }
        return redirect()->back()->with('create_failed', 'No se ha actualizado correctamente la información de su perfil');
    }

    public function update(\App\Http\Requests\User\UpdateUserRequest $request)
    {
        $validated = $request->validated();
        $update = $this->updateUser($validated);
        if ($update) {
            return redirect()->route('home')->with('update_complete', 'Se actualizó correctamente el perfil.');
        }
        return redirect()->route('home')->with('update_failed', 'No se ha actualizado correctamente la información de su perfil');
    }

    public function updatePassword(\App\Http\Requests\User\UpdateUserPasswordRequest $request)
    {
        $validated = $request->validated();
        $usuario = \App\User::where('email', $validated['email']);
        $update = $usuario->update(['password' => bcrypt($validated['password'])]);
        if ($update) {
            return redirect()->route('home')->with('update_complete', 'Se actualizó la contraseña correctamente.');
        }
        return redirect()->route('home')->with('update_failed', 'No se pudo actualizar la contraseña.');
    }

    public function updateDocument(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'exists:users,email'],
            'document_type_id' => ['required', 'exists:document_types,id']
        ];
        $attributes = [
            'document_type_id' => 'tipo de documento'
        ];
        $validated = $request->validate($rules, [], $attributes);
        $usuario = \App\User::where('email', $validated['email'])->first();
        $update = $usuario->document->update($validated);
        if ($update) {
            return redirect()->route('home')->with('update_complete', 'Se actualizó el tipo de documento correctamente.');
        }
        return redirect()->route('home')->with('update_failed', 'No se pudo actualizar el tipo de documento.');
    }

    private function updateUser($validated)
    {
        $usuario = \App\User::where('email', $validated['email'])->first();
        $usuario->update($validated);
        $usuario->document->update($validated);
        return $usuario;
    }

    private function insertUser($validated)
    {
        $document_type = \App\Models\Document_type::where('type', $validated['document_type_id'])->first();
        $usuario = \App\User::create([
            'name' => strtolower($validated['name']),
            'lastname' => strtolower($validated['lastname']),
            'email' => strtolower($validated['email']),
            'phone' => $validated['phone'],
            'address' => strtolower($validated['address']),
            'document_id' => \App\Models\Document::create([
                'document' => $validated['document'],
                'document_type_id' => $document_type->id,
            ])->id,
            'password' => bcrypt('1234')
        ]);
        return $usuario;
    }
}
