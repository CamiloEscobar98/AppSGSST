<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userImport(Request $request)
    {
        $rules = [
            'users' => ['required', 'file', 'mimes:xlsx']
        ];
        $attributes = ['users' => 'Archivo de capacitantes'];
        $validated = $request->validate($rules, [], $attributes);
        $file = $request->file('users');
        Excel::import(new \App\Imports\UsersImport, $file);
        return redirect()->back()->with('create_complete', 'Se registró correctamente a todos los usuarios');
    }

    public function create(\App\Http\Requests\User\CreateUserRequest $request)
    {
        $request->user()->authorizeRolesSession(['administrador']);
        $validated = $request->validated();
        $save = $this->insertUser($validated);
        if ($save) {
            return redirect()->back()->with('create_complete', 'Se registró correctamente el usuario: ' . $save->name . ' ' . $save->lastname);
        }
        return redirect()->back()->with('create_failed', 'No se ha registrado correctamente al usuario');
    }

    public function show(\App\User $usuario)
    {
        $roles = \App\Models\Role::all();
        $documents_type = \App\Models\Document_type::all();
        return view('auth.profiles.usuario', ['usuario' => $usuario, 'document_types' => $documents_type, 'roles' => $roles]);
    }

    public function update(\App\Http\Requests\User\UpdateUserRequest $request)
    {
        $validated = $request->validated();
        $update = $this->updateUser($validated);
        if ($update) {
            return redirect()->back()->with('update_complete', 'Se actualizó correctamente el perfil.');
        }
        return redirect()->back()->with('update_failed', 'No se ha actualizado correctamente la información de su perfil');
    }

    public function updatePassword(\App\Http\Requests\User\UpdateUserPasswordRequest $request)
    {
        $validated = $request->validated();
        $usuario = \App\User::where('email', $validated['email']);
        $update = $usuario->update(['password' => bcrypt($validated['password'])]);
        if ($update) {
            return redirect()->back()->with('update_complete', 'Se actualizó la contraseña correctamente.');
        }
        return redirect()->back()->with('update_failed', 'No se pudo actualizar la contraseña.');
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
            return redirect()->back()->with('update_complete', 'Se actualizó el tipo de documento correctamente.');
        }
        return redirect()->back()->with('update_failed', 'No se pudo actualizar el tipo de documento.');
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $usuario = \App\User::where('email', $request->usuario)->first();
            $aux = $usuario;
            if ($usuario->delete()) {
                return response()->json(['alert' => 'success', 'message' => 'Se ha eliminado correctamente a ' . $aux->name . ' ' . $aux->lastname]);
            }
        }
    }

    public function updatePhoto(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'exists:users,email'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048']
        ];
        $attributes = [
            'image' => 'foto de perfil'
        ];
        $validated = $request->validate($rules, [], $attributes);
        $usuario = \App\User::where('email', $validated['email'])->first();

        $image_path = public_path('storage/images/profiles') . '/' . $usuario->image->image;
        if ($usuario->image->image != 'default.png' && @getimagesize($image_path)) {
            unlink($image_path);
        }
        $image = $request->file('image');
        $nombre = time() . '_' . $usuario->document->document . '.' . $image->getClientOriginalExtension();
        $destino = public_path('storage/images/profiles');
        request()->image->move($destino, $nombre);
        $usuario->image->image = $nombre;
        $usuario->image->url = 'storage/images/profiles';
        $update = $usuario->image->save();
        if ($update) {
            return redirect()->back()->with('update_complete', 'Se actualizó correctamente la foto de perfil.');
        }
        return redirect()->back()->with('update_failed', 'No se pudo actualizar la foto de perfil.');
    }

    public function addRole(Request $request)
    {
        $rules = [
            'role' => ['required', 'exists:roles,name'],
            'email' => ['required', 'email', 'exists:users,email']
        ];
        $attributes = [
            'role' => 'rol de usuario',
        ];
        $validated = $request->validate($rules, [], $attributes);
        $usuario = \App\User::where('email', $validated['email'])->first();
        $role = \App\Models\Role::where('name', $validated['role'])->first();
        if (!$usuario->hasRole($role->name)) {
            $usuario->roles()->attach($role);
            return redirect()->back()->with('update_complete', 'Se agregó correctamente el rol de usuario.');
        }
        return redirect()->back()->with('update_failed', 'Ya tiene agregado este rol de usuario.');
    }

    public function deleteRole(Request $request)
    {
        if ($request->ajax()) {
            $usuario = \App\User::where('email', $request->usuario)->first();
            $role = \App\Models\Role::where('name', $request->role)->first();
            $usuario->roles()->detach($role->id);
        }
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
            'document_id' => \App\Models\Document::create([
                'document' => $validated['document'],
                'document_type_id' => $document_type->id,
            ])->id,
            'password' => bcrypt('1234')
        ]);
        $role = \App\Models\Role::where('name', $validated['role'])->first();
        $usuario->roles()->attach($role);
        $usuario->image()->create([
            'image' => 'default.png',
            'url' => 'storage/images/profiles'
        ]);
        return $usuario;
    }

    public function topics()
    {
        $user = \App\User::find(Auth()->user()->id);
        $topics = $user->topics;
        return view('auth.lists.mis-tematicas', ['topics' => $topics]);
    }
}
