<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class libroNotasController extends Controller
{
    public function create()
    {
        return view('estudiante.create',['estudiante' => new Estudiante]);
    }
}
