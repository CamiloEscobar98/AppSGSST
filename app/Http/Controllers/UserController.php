<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(\App\Http\Requests\User\UpdateUserRequest $request)
    {
        $validated = $request->validated();
        $update = $this->updateUser($validated);
        if ($update) {
            return redirect()->route('home', ['update_complete' => 'Se ha actualizado correctamente la información de su perfil']);
        }
        return redirect()->route('home', ['update_failed' => 'Se ha actualizado correctamente la información de su perfil']);
    }
    private function updateUser($validated)
    {
        $usuario = \App\User::where('email', $validated['email'])->first();
        $usuario->update($validated);
        $usuario->document->update($validated);
        return $usuario;
    }
}
