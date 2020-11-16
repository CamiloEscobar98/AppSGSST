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

    public function lista_capacitantes()
    {
        $capacitantes = \App\Models\Role::where('name', 'capacitante')->first()->users()->orderBy('id', 'DESC')->paginate(6);
        $documents_type = \App\Models\Document_type::all();
        return view('auth.lista-capacitantes', ['capacitantes' => $capacitantes, 'document_types' => $documents_type]);
    }
}
