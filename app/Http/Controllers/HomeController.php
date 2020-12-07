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

    public function lista_capacitantes(Request $request)
    {
        $request->user()->authorizeRolesSession(['administrador']);
        $capacitantes = \App\Models\Role::where('name', 'capacitante')->first()->users()->orderBy('id', 'DESC')->paginate(6);
        $documents_type = \App\Models\Document_type::all();
        return view('auth.lists.lista-capacitantes', ['capacitantes' => $capacitantes, 'document_types' => $documents_type]);
    }

    public function lista_capacitadores(Request $request)
    {
        $request->user()->authorizeRolesSession(['administrador']);
        $capacitadores = \App\Models\Role::where('name', 'capacitador')->first()->users()->orderBy('id', 'DESC')->paginate(6);
        $documents_type = \App\Models\Document_type::all();
        return view('auth.lists.lista-capacitadores', ['capacitadores' => $capacitadores, 'document_types' => $documents_type]);
    }

    public function lista_tematicas(Request $request)
    {
        $request->user()->authorizeRolesSession(['administrador']);
        $capacitadores = \App\Models\Role::where('name', 'capacitador')->first()->users;
        $tematicas = \App\Models\Topic::paginate(5);
        return view('auth.lists.lista-tematicas', ['tematicas' => $tematicas, 'capacitadores' => $capacitadores]);
    }

    public function lista_capsulas(Request $request)
    {
        $request->user()->authorizeRolesSession(['administrador']);
        $capsulas = \App\Models\Capsule::paginate(5);
        $tematicas = \App\Models\Topic::all();
        return view('auth.lists.lista-capsulas', ['capsulas' => $capsulas, 'tematicas' => $tematicas]);
    }
}
