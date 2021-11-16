<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class docenteController extends Controller
{
    public function __construct(){

        $this->middleware('auth.docente')->except('show');
    }
    public function index()
    {
        return view('docenteDashboard');
    }
}
