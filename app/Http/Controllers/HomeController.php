<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $documents_type = \App\Models\Document_type::all();
        return view('home', ['document_types' => $documents_type]);
    }

    public function perfil(\App\User $usuario)
    {
        $roles = \App\Models\Role::all();
        $documents_type = \App\Models\Document_type::all();
        return view('auth.profiles.usuario', ['usuario' => $usuario, 'document_types' => $documents_type, 'roles' => $roles]);
    }

    public function lista_capacitantes()
    {
        $capacitantes = \App\Models\Role::where('name', 'capacitante')->first()->users()->orderBy('id', 'DESC')->paginate(6);
        $documents_type = \App\Models\Document_type::all();
        return view('auth.lists.lista-capacitantes', ['capacitantes' => $capacitantes, 'document_types' => $documents_type]);
    }

    public function lista_capacitadores()
    {
        $capacitadores = \App\Models\Role::where('name', 'capacitador')->first()->users()->orderBy('id', 'DESC')->paginate(6);
        $documents_type = \App\Models\Document_type::all();
        return view('auth.lists.lista-capacitadores', ['capacitadores' => $capacitadores, 'document_types' => $documents_type]);
    }
}
