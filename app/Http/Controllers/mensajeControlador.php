<?php

namespace App\Http\Controllers;

use App\Mail\MensajeRecibido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mensajeControlador extends Controller
{
    public function store(Request $request)
    {
        $message = Request()->validate([
            'name'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'content'=>'required|min:3'
        ]);

        Mail::to('alvarado.monge@nuevageneracion.ed.cr')->queue(new MensajeRecibido ($message));

        //return new MensajeRecibido($message);

        return back()->with('status','Mensaje enviado');
    }


}
